<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ViewerController;
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

Route::prefix('cms/')->middleware('guest:admin,author')->group(function() {
    Route::get('{guard}/login' , [UserAuthController::class , 'showLogin'])->name('view.login');
    Route::post('{guard}/login' , [UserAuthController::class , 'login']);
});

Route::prefix('cms/admin')->middleware('auth:admin,author')->group(function() {
    Route::get('logout' , [UserAuthController::class , 'logout'])->name('view.logout');
});

Route::prefix('cms/admin/')->middleware('auth:admin,author')->group(function () {
    Route::get('home' , [HomePageController::class , 'showHome'])->name('view.home');
    Route::view('temp' , 'cms.temp');

    // Country-Route
    Route::resource('countries' , CountryController::class);
    Route::post('countries_update/{id}' , [CountryController::class , 'update' ])->name('countries_update');

    // City-Route
    Route::resource('cities' , CityController::class);
    Route::post('cities_update/{id}' , [CityController::class , 'update' ])->name('cities_update');

    // Admin-Route
    Route::resource('admins' , AdminController::class);
    Route::post('admins_update/{id}' , [AdminController::class , 'update' ])->name('admins_update');

    // Author-Route
    Route::resource('authors' , AuthorController::class);
    Route::post('authors_update/{id}' , [AuthorController::class , 'update' ])->name('authors_update');

     // Viewer-Route
     Route::resource('viewers' , ViewerController::class);
     Route::post('viewers_update/{id}' , [ViewerController::class , 'update' ])->name('viewers_update');


    // Category-Route
    Route::resource('categories' , CategoryController::class);
    Route::post('categories_update/{id}' , [CategoryController::class , 'update'])->name('categories_update');

    // Article-Route
    Route::resource('articles' , ArticleController::class);
    Route::post('articles_update/{id}' , [ArticleController::class , 'update'])->name('articles_update');
    Route::get('/create/articles/{id}', [ArticleController::class, 'createArticle'])->name('createArticle');
    Route::get('/index/articles/{id}', [ArticleController::class, 'indexArticle'])->name('indexArticle');

    // Slider-Route
    Route::resource('sliders' , SliderController::class);
    Route::post('sliders_update/{id}' , [SliderController::class , 'update'])->name('sliders_update');

     // Contact-Route
    Route::resource('contacts' , ContactController::class);
    Route::post('contacts_update/{id}' , [ContactController::class , 'update'])->name('contacts_update');

      // Comment-Route
    Route::resource('comments' , CommentController::class);
    Route::post('comments_update/{id}' , [CommentController::class , 'update'])->name('comments_update');


    // Rloe-Route
    Route::resource('roles' , RoleController::class);
    Route::post('roles_update/{id}' , [RoleController::class , 'update'])->name('roles_update');

    // Permission-Route
    Route::resource('permissions' , PermissionController::class);
    Route::post('permissions_update/{id}' , [PermissionController::class , 'update'])->name('permissions_update');

    // (Role && Permission)-Route
    Route::resource('roles.permissions' , RolePermissionController::class);

});

Route::prefix('news/')->group(function () {
    Route::get('home' , [HomeController::class , 'home'])->name('news.home');
    Route::get('det/{id}' , [HomeController::class , 'det'])->name('detailes');
    Route::get('all/{id}' , [HomeController::class , 'all'])->name('allNews');
    Route::get('contact' , [HomeController::class , 'showContact'])->name('allNews');

    Route::post('store' , [HomeController::class , 'storeContact'])->name('allNews');

});
