<?php

use App\Http\Controllers\user\AboutusController;
use App\Http\Controllers\User\AddressBookController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CategoryComponentController;
use App\Http\Controllers\User\CheckoutComponentController;
use App\Http\Controllers\User\CountriesController;
use App\Http\Controllers\User\CouponController;
use App\Http\Controllers\User\EmailMeController;
use App\Http\Controllers\User\FilterProductsComponentController;
use App\Http\Controllers\User\HeaderComponentController;
use App\Http\Controllers\User\HomeComponentController;
use App\Http\Controllers\User\ManageMyAccountcomponentController;
use App\Http\Controllers\User\OrdersController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ReviewsController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/  

        Route::group(['middleware' => 'auth:sanctum'],function(){
            Route::get('/logout',[AuthController::class,'logout']);
            Route::get('/user',[AuthController::class,'user']);
            Route::get('/userwithCart',[AuthController::class,'userwithCart']);

            //Cart
            Route::get('/CartComponent',[CartController::class,'index']);
            Route::post('/add-itemtocart/{slug}',[CartController::class,'create']);
            Route::post('/add-itemtocart/{slug}/{quantity}',[CartController::class,'createWithquantity']);
            Route::get('/remove-itemtocart/{slug}',[CartController::class,'remove']);
            Route::post('/update-cart',[CartController::class,'update']);
            Route::get('/clear-cart',[CartController::class,'DeleteAll']);
             //Checkout Component
            Route::get('/CheckoutComponent',[CheckoutComponentController::class,'index']);
            // wishlist
            Route::get('/WishListComponent',[WishlistController::class,'index']);
            Route::get('/add-itemtowishlist/{slug}',[WishlistController::class,'Create']);
            Route::get('/remove-itemtowishlist/{slug}',[WishlistController::class,'remove']);
            Route::get('/clear-wishlist',[WishlistController::class,'DeleteAll']);
            // ----- start  profile -----
            //--address book
            Route::apiResource('/AddressBook',AddressBookController::class);
            Route::get('/Make-Default/{id}',[AddressBookController::class,'makeDefault']);
            Route::get('/getCountries',[CountriesController::class,'index']);
            //--profile
            Route::patch('/Profile-Edit',[ProfileController::class,'updateProfile']);
            Route::get('/Change-Password-Component',[ProfileController::class,'changepasswordcomponent']);
            Route::patch('/Change-Password',[ProfileController::class,'changepassword']);
            Route::post('/Reset_Email',[ProfileController::class,'resetEmail']);

            //Oreders
            Route::post('/PlaceOrder',[OrdersController::class,'PlaceOrder']);
            Route::post('/PlaceOrderWithDefaultAddress',[OrdersController::class,'PlaceOrderWithDefaultAddress']);
            Route::get('/OrdersComponent',[OrdersController::class,'index']);
            Route::get('/getOrder/{ordernumber}',[OrdersController::class,'getorder']);
            Route::get('/getOrdersBy/{id}',[OrdersController::class,'filteredOrders']);
            Route::get('/CancelOrder/{order_number}',[OrdersController::class,'CancelOrder']);
            Route::get('/unCancelOrder/{order_number}',[OrdersController::class,'unCancelOrder']);
            Route::get('/CanceledOrders',[OrdersController::class,'getcancelorders']);
            // manage account
            Route::get('/Manage-My-Account-Component',[ManageMyAccountcomponentController::class,'index']);
            // ----- end  profile -----
            //reviews
            Route::post('/Create-Review',[ReviewsController::class,'create']);
            Route::get('/Delete-Review/{slug}',[ReviewsController::class,'delete']);
            //coupon
            Route::get('/Apply-Coupon/{coupon}',[CouponController::class,'index']);
            //email Me when price drope
            Route::get('/Email_me/{slug}',[EmailMeController::class,'index']);
            //feedback
            Route::post('/Feedback',[AboutusController::class,'feedback']);
            //get in touch
            Route::post('/Message',[AboutusController::class,'message']);




            



            
            
        });

    //Login - Register
        Route::post('/login',[AuthController::class,'login']);
        Route::post('/register',[AuthController::class,'register']);
        Route::get('/Login/{provider}',[AuthController::class,'SocialiteLogin']);
        Route::get('/Login/{provider}/callback',[AuthController::class,'SocialiteCallBack']);
        //component
        Route::get('/HomeComponent',[HomeComponentController::class,'index']);
        Route::get('/HeaderComponent',[HeaderComponentController::class,'index']);
        Route::get('/CategoryComponent/{slug}',[CategoryComponentController::class,'index']);
        Route::get('/FilterProductsComponent',[FilterProductsComponentController::class,'index']);
        Route::get('/FilterProducts/{numbers}/{show}/{id}',[FilterProductsComponentController::class,'Filter']);
        //product by slug
        Route::get('/Product/{slug}',[ProductController::class,'index']);
        //profile change email
        Route::get('/Check-Token/{token}',[ProfileController::class,'checktoken']);
        Route::post('/Change-Email',[ProfileController::class,'changeemail']);
        //Search
        Route::get('/Search/{name}',[SearchController::class,'index']);







