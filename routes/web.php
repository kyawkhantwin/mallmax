<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Ecommerce
Route::group(["namespace" => "Shop"],function (){
    Route::get('/',"ShopController@index");

    //product detail
    Route::get("/product/detail/{slug}","ShopController@productDetail");

    //product cart
    Route::get("/product/cart","ShopController@productCart")->middleware('notUser');;
    Route::get("/product/search","ShopController@search");

    //review
    Route::post("/product/review/{slug}","ShopController@postProductReview")->middleware('notUser');

    Route::get("/product/transaction","ShopController@transaction");
    Route::get("/product/transaction/{id}","ShopController@transactionDetail");
});


//    User Auth
Route::group(["namespace" => "Auth",'prefix' => 'user' ,'middleware' => 'user'],function (){
//    login user
    Route::get('/login',"AuthController@showLogin");
    Route::post('/login',"AuthController@postLogin");
//    Register user
    Route::get('/register',"AuthController@showRegister");
    Route::post('/register',"AuthController@postRegister");
//    logout
    Route::get('/user/logout',"AuthController@logOut");
});
Route::group(["namespace" => "Auth",'middleware' => 'notUser'],function (){
//    logout
    Route::get('/user/logout',"AuthController@logout");
});


//   ADMIN AUTH
Route::group(['prefix' => 'admin','namespace' => "Auth\Admin"],function (){
//   Admin login
    Route::get('/login', 'AdminAuthController@adminShowLogin' );
    Route::post('/login', 'AdminAuthController@adminPostLogin' );

//   Admin Register
    Route::get('/register', 'AdminAuthController@adminShowRegister' );
    Route::post('/register', 'AdminAuthController@adminPostRegister' );

    //   Admin logout
    Route::get('/logout', 'AdminAuthController@adminLogOut' );
});



//Route::group(['middleware' => 'web' , 'namespace' => 'Auth'], function () {
//    Route::get('login', 'LoginController@showLoginForm')->name('login');
//    Route::post('login', 'LoginController@login');
//    Route::post('logout', 'LoginController@logout')->name('logout');
//    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
//    Route::post('register', 'RegisterController@register');
//    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
//    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
//    Route::post('password/reset', 'ResetPasswordController@reset');
//});





 
//Admin
Route::group(["prefix" => "admin","namespace" => "Admin",'middleware' =>'admin'],function (){

    Route::get('/dashboard', 'DashboardController@Dashboard');
    Route::get('/transaction', 'DashboardController@Transaction');

//    Category
    Route::resource('/category',"CategoryController");

    Route::resource('/product',"ProductController");
    Route::resource('/brand',"BrandController");
});






//    Auth::routes(["namespace" => null]);

