<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::match(['get','post'],'/admin','AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Index Page
Route::get('/','IndexController@index');

//Category/Listing Page
Route::get('/products/{url}','ProductsController@products');

//Product Detail Page
Route::get('product/{id}','ProductsController@product');

//Add to Cart Route
Route::match(['get','post'],'/add-cart','ProductsController@addtocart');

//Cart Page
Route::match(['get','post'],'/cart','ProductsController@cart');

//Delete Product from Cart
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');

//Update Product Quantity in Cart
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

//Apply Coupon
Route::post('/cart/apply-coupon','ProductsController@applyCoupon');

//User Login/Register Page
Route::get('/login-register','UsersController@userLoginRegister');

//User Logout
Route::get('/user-logout','UsersController@logout');

//User Login
Route::post('/user-login','UsersController@login');

//User Register Form Submit
Route::post('/user-register','UsersController@register');

//Check If User already exists
Route::match(['GET','POST'],'/check-email','UsersController@checkEmail');

//All Routes after login
Route::group(['middleware'=>['frontlogin']],function (){
    //User Account Page
    Route::match(['get','post'],'account','UsersController@account');
    //Check User Current Password
    Route::post('/check-user-pwd','UsersController@chkUserPassword');
    //Update User Password
    Route::post('/update-user-pwd','UsersController@updatePassword');
});

Route::group(['middleware'=>['auth']],function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings','AdminController@settings');
    Route::get('/admin/check-pwd','AdminController@chkPassword');
    Route::match(['get','post'], '/admin/update-pwd','AdminController@updatePassword');

    // Categorie Routes (Admin)
    Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
    Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
    Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
    Route::get('/admin/view-categories','CategoryController@viewCategories');
    Route::get('/admin/delete-category-image/{id}','CategoryController@deleteCategoryImage');

    // Products Routes
    Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
    Route::get('/admin/view-products','ProductsController@viewProducts');
    Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');
    Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');

    //Coupon
    Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
    Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
    Route::get('/admin/view-coupons','CouponsController@viewCoupons');
    Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');
});


Route::get('/logout', 'AdminController@logout');
