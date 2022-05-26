<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\FeedBacksController;
use App\Http\Controllers\Admin\LoginContoller;
use App\Http\Controllers\Admin\MassagesController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TrashController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['guest:admin'])->group(function () {  
        Route::get('/login',[LoginContoller::class,'index'])->name('admin.login');
        Route::post('/login',[LoginContoller::class,'login'])->name('admin.attempt'); 
        
});

Route::middleware(['adminauth:admin'])->group(function () {
    //profile
    Route::get('/',[DashboardController::class,'dashbord'])->name('admin.dashbord');
    Route::get('/logout',[DashboardController::class,'logout'])->name('admin.logout');
    Route::get('/profile',[DashboardController::class,'profile'])->name('admin.profile');
    Route::post('/profile',[DashboardController::class,'update'])->name('admin.profile.update');
    Route::get('/Change-Password',[DashboardController::class,'password'])->name('admin.password');
    Route::post('/Change-Password',[DashboardController::class,'changepassword'])->name('admin.password.update');
    // category
    Route::resource('Category',CategoryController::class)->except('show');
    Route::get('/Category/active/{id}',[CategoryController::class,'active'])->name('Category.active');
    // slider
    Route::resource('/Slider',SliderController::class)->except('show');
    Route::get('/Slider/active/{id}',[SliderController::class,'active'])->name('Slider.active');
    // Product
    Route::resource('/Product',ProductController::class);
    Route::get('/Product/active/{id}',[ProductController::class,'active'])->name('Product.active');
    Route::get('/Product/delete_photo/{photo}',[ProductController::class,'photodelete'])->name('Product.photo');
    // Roles
    Route::resource('/Roles',RoleController::class)->except(['show']);
    // Admin
    Route::resource('/Admins',AdminController::class)->except('show');
    Route::get('/Admin/active/{id}',[AdminController::class,'active'])->name('Admin.active');
    //site Sitting
    Route::resource('/Settings',SettingController::class)->except(['show','create','destroy','store']);
    // cache clear 
    Route::get('/Clear-Cache',[SettingController::class,'ClearCache'])->name('Cache-Clear');
    // notification
    Route::get('All-Notification',[NotificationController::class,'index']);
    Route::get('/Read-All-Notification',[NotificationController::class,'readnotification']);
    // Discounts
    Route::resource('/Discount',DiscountController::class)->except(['show']);
    Route::get('/Discount/active/{id}',[DiscountController::class,'active'])->name('Discount.active');
    Route::get('/categories/discount',[DiscountController::class,'categories']);
    Route::get('/products/discount',[DiscountController::class,'products']);
    Route::get('/categories/all/{id}',[DiscountController::class,'allcategories']);
    Route::get('/products/all/{id}',[DiscountController::class,'allproducts']);
    //Coupon
    Route::resource('/Coupon',CouponController::class)->except(['show']);
    Route::get('/Coupon/active/{id}',[CouponController::class,'active'])->name('Coupon.active');
    // Trash
    Route::get('/Trash',[TrashController::class,'index'])->name('Trash');
    Route::get('/allTrashed-Data',[TrashController::class,'allTrashed']);
    Route::get('/Trashed-categories',[TrashController::class,'category']);
    Route::get('/Trashed-products',[TrashController::class,'product']);
    Route::get('/Trashed-sliders',[TrashController::class,'slider']);
    Route::delete('/Trashed-deleted/{id}/{type}',[TrashController::class,'delete'])->name('Trashed.delete');
    Route::get('/Trashed-restore/{id}/{type}',[TrashController::class,'restore'])->name('Trashed.restore');
    Route::get('/Trashed-edit/{id}/{type}',[TrashController::class,'edit'])->name('Trashed.edit');
    //Orders
    Route::get('/Orders',[OrdersController::class,'index'])->name('admin.Orders');
    Route::get('Orders/{id}/{status}',[OrdersController::class,'update'])->name('order.update');
    Route::get('Orders/{id}',[OrdersController::class,'show'])->name('Order.show');
    //users
    Route::get('/Users',[UsersController::class,'index'])->name('admin.Users');
    Route::get('/Ban-User/{ip_address}',[UsersController::class,'banUser'])->name('Ban-User');
    Route::get('/unBan-User/{ip_address}',[UsersController::class,'unbanUser'])->name('unBan-User');
    //massages 
    Route::get('/Massages',[MassagesController::class,'index'])->name('admin.Massages');
    Route::delete('/Massages/Delete/{id}',[MassagesController::class,'delete'])->name('Massages.delete');
    //feedback
    Route::get('/Feedback',[FeedBacksController::class,'index'])->name('admin.Feedback');
    Route::delete('/Feedback/Delete/{id}',[FeedBacksController::class,'delete'])->name('feedback.delete');
    Route::get('/Feedback/active/{id}',[FeedBacksController::class,'active'])->name('Feedback.active');

    Route::fallback(function () {
        abort(404);
    });

    
  });






