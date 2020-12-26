<?php
use App\Http\Controllers\Admin\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function () {
    //all the admin route will be defind here:-
    Route::match(['get','post'],'/','AdminController@login');
    Route::group(['middleware'=>['admin']],function(){
        Route::get('dashboard','AdminController@dashboard');
        Route::get('logout','AdminController@logout');
        Route::get('settings','AdminController@settings');
        Route::match(['get','post'],'check-current-pwd','AdminController@checkCurrentPassword');
        Route::post('update_pwd','AdminController@updateCurrentPassword');
        Route::match(['get','post'],'update-admin-details','AdminController@updateAdminDetails');
        //sections
        Route::get('sections','SectionsController@sections');
        Route::post('update-section-status','SectionsController@statusUpdate');
        //category
        Route::get('categories','CategoryController@categories');
        Route::post('update-category-status','CategoryController@UpdateCategoryStatus');
        Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addEditCategory');
        Route::post('appen-category-level','CategoryController@appCategoryLevel');
        Route::get('delete-category-image/{id}','CategoryController@deleteCtgImage');
        Route::get('delete-category/{id}','CategoryController@deleteCategory');

        //products
        Route::get('products','ProductsController@allProducts');
        Route::post('update-product-status','ProductsController@UpdateproductStatus');
        Route::get('delete-product/{id}','ProductsController@deleteProduct');
        Route::match(['get','post'],'add-edit-product/{id?}','ProductsController@addEditProduct');
        Route::get('delete-main-image/{id}','ProductsController@deleteproductImage');
        Route::get('delete-product-video/{id}','ProductsController@deleteproductVideo');

        //attributes
        Route::match(['get', 'post'], 'add-edit-attribute/{id}', 'ProductsController@addeditattribute');

    });
});
