<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddressBookRequest;
use App\Models\Users\Address;
use App\Models\Users\Countries;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
       $Address =  Address::where('user_id',$user_id)->with('country')->get();
       return Api_response('success',200,$Address);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressBookRequest $request)
    {   
     try {
        $user_id = Auth::id();
         $checkfirst= Address::where('user_id',$user_id)->first();
         if ($checkfirst) {
           $default = 0;
         }else{
             $default = 1 ;
         }
         Address::create([
             'country_id' => $request->country_id,
             'street_address' => $request->street_address,
             'user_id' => $user_id,
             'state' => $request->state,
             'first_name'=> $request->first_name,
             'last_name'=> $request->last_name,
             'city' => $request->city,
             'default' => $default ,
             'zipcode' => $request->zip_code,
             'phone' => $request->phone,
         ]);
         return Api_response('Address Created Successfully',200,'');
     } catch (\Throwable $th) {
        return Api_response('Somthing Went Wrong Try Again Later',419,'');
     }       
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id =Auth::id();
       $address = Address::where([['user_id',$user_id],['id',$id]])->first();
       if ($address) {
        $countries =  Countries::ApiSelection()->get();
        $api=[
            'countries' => $countries,
            'address' => $address
        ];
           return Api_response('success',200,$api);
       }
       return Api_response('',404,'');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressBookRequest $request, $id)
    {
        try {
            $user_id =Auth::id();
        $address = Address::where([['user_id',$user_id],['id',$id]])->first();
        if ($address) {
        $address->update([
            'country_id' => $request->country_id,
            'street_address' => $request->street_address,
            'user_id' => $user_id,
            'state' => $request->state,
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'city' => $request->city,
            'zipcode' => $request->zip_code,
            'phone' => $request->phone,
        ]);
        return Api_response('Address Updated Successfully',200,'');
        }else{
            return Api_response('',404,'');  
        }
        } catch (\Throwable $th) {
            return Api_response('Somthing Went Wrong Please Try Again Later',404,'');  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Auth::id();
        $deletedaddress = Address::where([['user_id',$user_id],['id',$id]])->first();
        if ($deletedaddress) {
         switch ($deletedaddress->default) {
             case 1:
                //check if there is  address has default = 0
                $address = Address::where([['user_id',$user_id],['default',0]])->first();
                if ($address) {
                   $address->update([
                       'default' => 1
                   ]);
                }
                $deletedaddress->delete();
                $returnAddress = Address::where('user_id',$user_id)->with('country')->get();
                return Api_response('Address Book Deleted Successfully',200,$returnAddress);
                 break;
            case 0:
                $deletedaddress->delete();
                $returnAddress = Address::where('user_id',$user_id)->with('country')->get();
                return Api_response('Address Book Deleted Successfully',200,$returnAddress);
                break;
             
             default:
             return Api_response('Somthing Went Wrong Please Try Again Later',404,'');  
                 break;
         }
        }
        return Api_response('Somthing Went Wrong Please Try Again Later',404,'');  
       
    }
    public function makeDefault($id){
        $user_id = Auth::id();
        $samedefaultaddress = Address::where([['user_id',$user_id],['id',$id],['default',1]])->first();
        if(!$samedefaultaddress){
           $NewDefaultAddress= Address::where([['user_id',$user_id],['id',$id]])->first();
            if ($NewDefaultAddress) {
                $address =  Address::where([['user_id',$user_id],['default',1]])->first();
                if ($address) {
                   $address->update([
                        'default' => 0,
                   ]);
                }
                $NewDefaultAddress->update([
                    'default'=> 1,
                ]);
                return Api_response('Address Updated Successfully',200,'');
            }
            return Api_response('Somthing Went Wrong Please Try Again Later',200,'');
        }else{
            return Api_response('Address Updated Successfully',200,'');
        }
           


        
    }
}
