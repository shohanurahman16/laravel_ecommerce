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


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



/*
|--------------------------------------------------------------------------
| Pages Routes
|--------------------------------------------------------------------------
*/
Route::get('/', 'PagesController@index')->name('index');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/search', 'PagesController@search')->name('search');


/*
|--------------------------------------------------------------------------
| Products Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'products'], function(){
    Route::get('/', 'ProductsController@index')->name('products.index');
    Route::get('/{slug}', 'ProductsController@show')->name('products.show');

    Route::get('/categories', 'ProductsController@allCategoryProducts')->name('all_category_products');
    Route::get('/category/{id}', 'ProductsController@categoryWiseProducts')->name('category_wise_products');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'user'], function (){

    Route::get('/token/{token}', 'VerificationController@verify')->name('user.verification');
    Route::get('/dashboard', 'UsersController@dashboard')->name('user.dashboard');
    Route::get('/profile', 'UsersController@profile')->name('user.profile');
    Route::post('/profile/update', 'UsersController@update')->name('user.profile.update');

});

/*
|--------------------------------------------------------------------------
| Carts Routes
|--------------------------------------------------------------------------
*/
Route::get('/carts', 'CartsController@index')->name('carts');
Route::post('/carts/store', 'CartsController@store')->name('carts.store');
Route::post('/carts/update/{id}', 'CartsController@update')->name('carts.update');
Route::post('/carts/delete/{id}', 'CartsController@destroy')->name('carts.delete');


/*
|--------------------------------------------------------------------------
| Admin Pages Routes
|--------------------------------------------------------------------------
*/
Route::get('admin/', 'AdminPagesController@index')->name('admin.index');




/*
|--------------------------------------------------------------------------
| Admin Products Routes
|--------------------------------------------------------------------------
*/
Route::resource('admin/products', 'AdminProductsController',['names'=>[
    'index'=>'admin.products.index',
    'create'=>'admin.products.create',
    'store'=>'admin.products.store',
    'edit'=>'admin.products.edit',
    'show'=>'admin.products.show',
    'update'=>'admin.products.update',
    'destroy'=>'admin.products.destroy',
]]);

/*
|--------------------------------------------------------------------------
| Admin Orders Routes
|--------------------------------------------------------------------------
*/
Route::resource('admin/orders', 'OrdersController',['names'=>[
    'index'=>'admin.orders.index',
    'show'=>'admin.orders.show',
]]);
Route::post('admin/orders/edit/{id}', 'OrdersController@update')->name('admin.orders.update');
Route::post('admin/orders/delete/{id}', 'OrdersController@destroy')->name('admin.orders.delete');
Route::post('admin/orders/deletee/{id}', 'OrdersController@delete')->name('admin.orders.deletee');
Route::post('admin/completed/{id}', 'OrdersController@completed')->name('admin.orders.completed');
Route::post('admin/paid/{id}', 'OrdersController@paid')->name('admin.orders.paid');

Route::post('admin/charge-update/{id}', 'OrdersController@chargeUpdate')->name('admin.orders.charge');

Route::get('admin/invoice/{id}', 'OrdersController@generateInvoice')->name('admin.orders.invoice');


/*
|--------------------------------------------------------------------------
| Admin Categories Routes
|--------------------------------------------------------------------------
*/
Route::resource('admin/categories', 'CategoriesController',['names'=>[
    'index'=>'admin.categories.index',
    'create'=>'admin.categories.create',
    'store'=>'admin.categories.store',
    'edit'=>'admin.categories.edit',
    'show'=>'admin.categories.show',
    'destroy'=>'admin.categories.destroy',
]]);
Route::post('admin/category/edit/{id}', 'CategoriesController@update')->name('admin.categories.update');




/*
|--------------------------------------------------------------------------
| Admin Brands Routes
|--------------------------------------------------------------------------
*/
Route::resource('admin/brands', 'BrandsController',['names'=>[
    'index'=>'admin.brands.index',
    'create'=>'admin.brands.create',
    'store'=>'admin.brands.store',
    'edit'=>'admin.brands.edit',
    'show'=>'admin.brands.show',
    'destroy'=>'admin.brands.destroy',
]]);
Route::post('admin/brand/edit/{id}', 'BrandsController@update')->name('admin.brands.update');



/*
|--------------------------------------------------------------------------
| Admin Divisions Routes
|--------------------------------------------------------------------------
*/
Route::resource('admin/divisions', 'DivisionsController',['names'=>[
    'index'=>'admin.divisions.index',
    'create'=>'admin.divisions.create',
    'store'=>'admin.divisions.store',
    'edit'=>'admin.divisions.edit',
    'show'=>'admin.divisions.show',
    'destroy'=>'admin.divisions.destroy',
]]);
Route::post('admin/divisions/edit/{id}', 'DivisionsController@update')->name('admin.divisions.update');


/*
|--------------------------------------------------------------------------
| Admin District Routes
|--------------------------------------------------------------------------
*/
Route::resource('admin/districts', 'DistrictsController',['names'=>[
    'index'=>'admin.districts.index',
    'create'=>'admin.districts.create',
    'store'=>'admin.districts.store',
    'edit'=>'admin.districts.edit',
    'show'=>'admin.districts.show',
    'destroy'=>'admin.districts.destroy',
]]);
Route::post('admin/districts/edit/{id}', 'DistrictsController@update')->name('admin.districts.update');


/*
|--------------------------------------------------------------------------
| Products Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'checkouts'], function(){
    Route::get('/', 'CheckoutsController@index')->name('checkouts');
    Route::post('/store', 'CheckoutsController@store')->name('checkouts.store');
});