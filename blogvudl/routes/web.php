<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\NotificationSendController;
use App\Http\Controllers\Auth\LoginController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

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

// Route::get('/oke',function(){
//     Post::addAllToIndex();
// });

Route::get('/', [HomePageController::class,'homepage'])->name('homepage');

Auth::routes(['verify'=> true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/login-google', [LoginController::class, 'logingoogle'])->name('login-google');
Route::any('/callback/google', [LoginController::class, 'callbackgoogle']);

Route::get('/login-facebook', [LoginController::class, 'loginfacebook'])->name('login-facebook');
Route::any('/callback/facebook', [LoginController::class, 'callbackfacebook']);


Route::get('/cat-index',[CategoryController::class,'index'])->name('ad.category-index');
Route::get('/cat-search',[CategoryController::class,'search']);
Route::get('/cat-delete/{id}',[CategoryController::class,'destroy'])->name('ad.category-delete');

Route::get('/cat-create',[CategoryController::class,'create'])->name('ad.category-create');
Route::post('/cat-store',[CategoryController::class,'store'])->name('ad.category-store');
Route::get('/cat-edit/{id}',[CategoryController::class,'edit'])->name('ad.category-edit');
Route::post('/cat-update/{id}',[CategoryController::class,'update'])->name('ad.category-update');


Route::get('/post-index',[PostController::class,'index'])->name('ad.post-index');
Route::get('/post-search',[PostController::class,'search1']);
Route::get('/post-search/elasticsearch',[PostController::class,'elasticsearchQueries']);
Route::get('/post-delete/{id}',[PostController::class,'destroy'])->name('ad.post-delete');
Route::get('/post-sort',[PostController::class,'sort'])->name('ad.post-sort');
Route::get('/post-ofcategory/{id}',[PostController::class,'postOfCategory'])->name('ad.post-ofcategory');
Route::post('crop',[PostController::class, 'crop'])->name('ad.post-crop');

Route::get('/post-create',[PostController::class,'create'])->name('ad.post-create');
Route::post('/post-store',[PostController::class,'store'])->name('ad.post-store');

Route::get('/post-edit/{id}',[PostController::class,'edit'])->name('ad.post-edit');
Route::post('/post-update/{id}',[PostController::class,'update'])->name('ad.post-update');


Route::get('/user-index',[UserController::class,'index'])->name('ad.user-index');
Route::get('/user-search',[UserController::class,'search']);
Route::get('/user-delete/{id}',[UserController::class,'destroy'])->name('ad.user-delete');

Route::get('/tag-index',[TagController::class,'index'])->name('ad.tag-index');
Route::get('/tag-create',[TagController::class,'create'])->name('ad.tag-create');
Route::post('/tag-store',[TagController::class,'store'])->name('ad.tag-store');

Route::get('/tag-edit/{id}',[TagController::class,'edit'])->name('ad.tag-edit');
Route::post('/tag-update/{id}',[TagController::class,'update'])->name('ad.tag-update');
Route::get('/tag-delete/{id}',[TagController::class,'destroy'])->name('ad.tag-delete');

Route::get('/page-detail/category/{slug}',[HomePageController::class,'categoryDetail'])->name('page.category-detail');
Route::get('/page-detail/{slug}',[HomePageController::class,'postdetail'])->name('page.post-detail');

Route::get('/page-detail-tag/{slug}',[HomePageController::class,'tag'])->name('page.tag-detail');
Route::get('/tag-search',[TagController::class,'search']);

Route::get('/search-post',[HomePageController::class,'searchPost'])->name('search-post');


Route::get('users-export',[ExcelController::class, 'exportExcelUser'])->name('users.export');
Route::post('users-import',[ExcelController::class, 'importExcelUser'])->name('users.import');

Route::get('posts-export',[ExcelController::class, 'exportExcelPost'])->name('posts.export');
Route::post('posts-import',[ExcelController::class, 'importExcelPost'])->name('posts.import');

Route::group(['middleware' => 'auth'],function(){
    Route::post('/store-token', [NotificationSendController::class, 'updateDeviceToken'])->name('store.token');
    Route::post('/send-web-notification', [NotificationSendController::class, 'sendNotification'])->name('send.web-notification');
});