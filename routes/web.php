<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
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
    $brands = \App\Models\Brand::all();
    $sliders = \App\Models\Slider::all();
    $homeAbout = \App\Models\HomeAbout::all()->first();
    $images = \App\Models\Multipic::all();
    return view('home', compact('brands', 'sliders', 'homeAbout', 'images'));
});

//Route::get('/home', function () {
//    return view('home');
//});

Route::get('/about', function () {
    return view('about');
});

//Route::get('/contact', function () {
//    return view('contact');
//});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/category/all', [CategoryController::class, 'allCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'addCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'editCat']);
Route::post('/category/update/{id}', [CategoryController::class, 'updateCat']);
Route::get('/category/softdelete/{id}', [CategoryController::class, 'softDeleteCat']);
Route::get('/category/delete/{id}', [CategoryController::class, 'deleteCat']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCat']);

//For Brand
Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'addBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'editBrand']);
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);
Route::get('/brand/delete/{id}', [BrandController::class, 'deleteBrand']);

// Multi image
Route::get('/multi/images', [BrandController::class, 'multiPic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'storeImg'])->name('store.image');

//email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = \App\Models\User::all();
    return view('admin.index');
})->name('dashboard');


Route::get('/user/logout', [BrandController::class, 'logout'])->name('user.logout');

//slider
Route::get('/home/slider', [HomeController::class, 'homeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'addSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'storeSlider'])->name('store.slider');

//about
Route::get('/home/about', [AboutController::class, 'homeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'addAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'storeAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'editAbout']);
Route::post('/update/homeabout/{id}', [AboutController::class, 'updateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'deleteAbout']);

// Portfolio
Route::get('/portfolio', [AboutController::class, 'portfolio'])->name('portfolio');

// Admin Contact Page Route
Route::get('/admin/contact', [ContactController::class, 'adminContact'])->name('admin.contact');

