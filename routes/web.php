<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
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

Route::get('/home', function () {
    return view('welcome');
});

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
Route::get('/category/delete/{id}', [CategoryController::class, 'DeleteCat']);
Route::get('/category/restore/{id}', [CategoryController::class, 'deleteCat']);

//For Brand
Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.brand');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = \App\Models\User::all();
    return view('dashboard', compact('users'));
})->name('dashboard');
