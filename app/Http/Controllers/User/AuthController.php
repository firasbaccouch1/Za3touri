<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\Users\User;
use App\Trait\CartTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AuthController extends Controller
{
    use CartTrait;
    public function login(Request $request){
    try {
        $credentials = [
            'email' => $request->email,
            'password'=> $request->password,
 
         ];
  
         if (Auth::attempt($credentials)) {
            $user =Auth::user();
            Cookie::queue('checkauth', 'true', 1440, null, null, false, false);
            return Api_response(__('messages.login'),200,$user);
         }      
            return Api_response(__('messages.error_login'),401);
    } catch (\Throwable $th) {
        return Api_response($th,500);
    }
    }
    public function register(RegisterRequest $request){
           
                $img = 'frontend/images/profile/default/Male.png';
                if ($request->gender == 'Female') {
                    $img = 'frontent/images/profile/default/Female.png';
                }
                User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'photo' =>  $img,
                    'ip_address' => request()->ip(),

                ]);
                return Api_response(__('messages.register'),200);

    }
    public function logout(){
        try {
            Auth::guard('web')->logout();
            Cookie::queue('checkauth', 'false', 1440, null, null, false, false);
            return Api_response(__('messages.logout'),200);
        } catch (\Throwable $th) {
            return Api_response($th,500);
        }
        
    }
    public function user(){
        $user_id = Auth::id();
         $user= User::where('id',$user_id)->withCount(['wishlist','order','order as cancel_orders_count' => function (Builder $query) {
            $query->where('status', 'cancel');
          }])->first();
            return Api_response(null,200,$user);
  
    }
    public function userwithCart(){
        $user_id = Auth::id();
         $user= User::where('id',$user_id)->withCount(['wishlist','order','order as cancel_orders_count' => function (Builder $query) {
            $query->where('status', 'cancel');
          }])->first();
          $Api= [
              'user' => $user,
            'Cart' =>  $this->getCart(),
        ];
        return Api_response('success',200,$Api);
    }
    public function SocialiteLogin($provider){
        $drive = ['google','facebook'];

        if (Auth::check()) {
            Alert::warning('You are already logged in');
            return redirect('/');
        }
        if (!in_array($provider,$drive)) {
            Alert::warning("can't Login with $provider" , 'You Have To login With Facebook Or Google ');
                  return redirect('/login');
       }
        return Socialite::driver($provider)->redirect();
    }
    public function SocialiteCallBack($provider){
        $drive = ['google','facebook'];
             if (!in_array($provider,$drive)) {
                Alert::warning("can't Login with $provider" , 'You Have To login With Facebook Or Google ');
                       return redirect('/login');
            }
            try {
                $user = Socialite::driver($provider)->stateless()->user();
            } catch (ClientException $exception) {
                Alert::warning("Error" , 'Somthing went wrong try again later');
            }
            $name =explode(' ',$user->getName());
            if (count($name) >= 2 ) {
                $name1 = $name[1];
            }else{
                $name1 =$name[0];
            }
            $userCreated = User::firstOrCreate(
                [
                    'email' => $user->getEmail(),

                ],
                [
                    'first_name' =>  $name[0],
                    'last_name'=> $name1,
                    'email_verified_at' => now(),
                    
                ]
            );
            Auth::login($userCreated);
            Alert::success('Logged in Successfully');
            return redirect('/');



    }


}
