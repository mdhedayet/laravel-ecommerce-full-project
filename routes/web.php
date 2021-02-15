<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\FrontProductsController;
use Illuminate\Support\Facades\Route;
use App\Category;

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


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function () {
    //all the admin route will be defind here:-
    Route::match(['get','post'],'/',[AdminController::class, 'login']);
    Route::group(['middleware'=>['admin']],function(){
        Route::get('dashboard',[AdminController::class, 'dashboard']);
        Route::get('logout',[AdminController::class, 'logout']);
        Route::get('settings',[AdminController::class, 'settings']);
        Route::match(['get','post'],'check-current-pwd',[AdminController::class, 'checkCurrentPassword']);
        Route::post('update_pwd',[AdminController::class, 'updateCurrentPassword']);
        Route::match(['get','post'],'update-admin-details',[AdminController::class, 'updateAdminDetails']);
        //sections
        Route::get('sections',[SectionsController::class, 'sections']);
        Route::post('update-section-status',[SectionsController::class, 'statusUpdate']);
        //category
        Route::get('categories', [CategoryController::class, 'categories']);
        Route::post('update-category-status', [CategoryController::class, 'UpdateCategoryStatus']);
        Route::match(['get','post'],'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory']);
        Route::post('appen-category-level', [CategoryController::class, 'appCategoryLevel']);
        Route::get('delete-category-image/{id}', [CategoryController::class, 'deleteCtgImage']);
        Route::get('delete-category/{id}', [CategoryController::class, 'deleteCategory']);

        //products
        Route::get('products', [ProductsController::class, 'allProducts']);
        Route::post('update-product-status', [ProductsController::class, 'UpdateproductStatus']);
        Route::get('delete-product/{id}', [ProductsController::class, 'deleteProduct']);
        Route::match(['get','post'],'add-edit-product/{id?}', [ProductsController::class, 'addEditProduct']);
        Route::get('delete-main-image/{id}', [ProductsController::class, 'deleteproductImage']);
        Route::get('delete-product-video/{id}', [ProductsController::class, 'deleteproductVideo']);

        //attributes
        Route::match(['get', 'post'], 'add-edit-attribute/{id}',  [ProductsController::class, 'addeditattribute']);
        Route::match(['get', 'post'], 'edit-attribute/{id}',  [ProductsController::class, 'editattribute']);
        Route::post('update-attribute-status', [ProductsController::class, 'UpdateattributeStatus']);
        Route::get('delete-attribute/{id}', [ProductsController::class, 'deleteattribute']);

        //images
        Route::match(['get', 'post'], 'add-images/{id}',  [ProductsController::class, 'addimages']);
        Route::post('update-image-status', [ProductsController::class, 'UpdateimageStatus']);
        Route::get('delete-image/{id}', [ProductsController::class, 'deleteimage']);


        //brands
        Route::get('brands', [BrandController::class, 'Brands']);
        Route::post('update-brand-status', [BrandController::class, 'Updatebrandsstatus']);
        Route::match(['get', 'post'], 'add-edit-brand/{id?}',  [BrandController::class, 'addeditbrand']);
        Route::get('delete-brand/{id}', [BrandController::class, 'deletebrand']);

        //banners
        Route::get('banners', [BannersController::class, 'banners']);
        Route::post('update-banner-status', [BannersController::class, 'Updatebannersstatus']);
        Route::get('delete-banner/{id}', [BannersController::class, 'deletebanner']);
        Route::match(['get', 'post'], 'add-edit-banner/{id?}',  [BannersController::class, 'addeditbanners']);
        Route::get('delete-banner-image/{id}', [BannersController::class, 'deletebannerImage']);
    });
});

Route::namespace('Front')->group(function(){
    //home page
    Route::get('/', [IndexController::class, 'index']);
    //listing page
    $caturl = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
    foreach ($caturl as $url) {
        Route::get('/'.$url,  [FrontProductsController::class, 'listing']);
    }
    //product details page
    Route::get('/product/{id}', [FrontProductsController::class, 'detail']);
});
