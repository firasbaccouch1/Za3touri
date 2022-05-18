<?php
namespace App\Http\Services;

use App\Jobs\SendEmailDiscountJob;
use App\Models\Admin\Product;
use App\Models\Users\User;
use App\Notifications\EmailMeNotfication;
use App\Trait\EmailMeTrait;
use Illuminate\Support\Facades\Notification;


class EmailMeWhenPriceDrop {

    use EmailMeTrait;
  

    function SendEmailToUsersDiscount($product,$discount) {
        if ($product) {
            $data =$this->preparingEmailData($product->slug);
            if ($data != null) {
                foreach ($data['users'] as $index => $value) {
                    $email= $value['email'];
                    $user =User::where('email',$email)->first();
                    $filtreddata=$data;
                    $filtreddata['users']=$filtreddata['users'][$index]; 
                    Notification::send($user,new EmailMeNotfication($filtreddata));
                }
            }  
        }else{
             $discountCategory = $discount->category;
             $slugs = Product::where('category_id',$discountCategory->id)->whereHas('emailme')->pluck('slug');
     foreach ($slugs as  $slug) {
          $data =$this->preparingEmailData($slug);
          if ($data != null) {
             foreach ($data['users'] as $index => $value) {
                 $email= $value['email'];
                 $user =User::where('email',$email)->first();
                 $filtreddata=$data;
                 $filtreddata['users']=$filtreddata['users'][$index]; 
                 Notification::send($user,new EmailMeNotfication($filtreddata));
             }
         }  
     }
     }
    }
    function SendEmailToUsersProduct($product,$oldprice) {   
            $data =$this->preparingEmailData($product->slug,$oldprice);
            if ($data != null) {
             foreach ($data['users'] as $index => $value) {
                 $filtreddata=$data;
                  $email =$value['email'];
                  $user = User::where('email',$email)->first();
                 $filtreddata['users']=$filtreddata['users'][$index]; 
                 Notification::send($user,new EmailMeNotfication($filtreddata));
                }   
            }
     
        
    }




}