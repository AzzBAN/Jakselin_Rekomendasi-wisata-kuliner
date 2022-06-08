<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardKulinerController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\User;

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



Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

// LOGIN ROUTE
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login/auth', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);
// END LOGIN ROUTE


//User
Route::get('/User/create', [UserController::class, 'create'])->middleware('guest');

Route::post('/User/store', [UserController::class, 'store']);

Route::get('/User/profile', [UserController::class, 'index'])->middleware('auth');

Route::get('/User/profile/edit', [UserController::class, 'edit']);

Route::put('/User/profile/edit', [UserController::class, 'update']);

//Wisata
// Route::get('/Wisata', [KulinerController::class, 'index']);

//show data
Route::get('/wisata', [KulinerController::class, 'index'])->middleware('auth');

Route::get('/wisata/{wisataKuliner}', [KulinerController::class, 'show'])->middleware('auth');

Route::get('/{category:name}', [CategoryController::class, 'index'])->middleware('auth');


//komentar
Route::post('/comment/post', [CommentController::class, 'store'])->middleware('auth');
//Dashboard
// Route::get('/dashboard', function(){
//     return view('Dashboard.home');
// });

Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('auth')->middleware('admin');
Route::resource('/dashboard/users', DashboardUserController::class)->middleware('auth')->middleware('admin');
Route::get('/dashboard/kuliner/create', [DashboardKulinerController::class, 'create'])->middleware('auth')->middleware('admin');
Route::post('/dashboard/kuliner/store', [DashboardKulinerController::class, 'store'])->middleware('auth')->middleware('admin');
Route::get('/dashboard/kuliner/{wisataKuliner}', [DashboardKulinerController::class, 'show'])->middleware('auth')->middleware('admin');
Route::get('/dashboard/kuliner/{wisataKuliner}/edit', [DashboardKulinerController::class, 'edit'])->middleware('auth')->middleware('admin');
Route::put('/dashboard/kuliner/{wisataKuliner}', [DashboardKulinerController::class, 'update'])->middleware('auth')->middleware('admin');
Route::put('/dashboard/kuliner/{wisataKuliner}/destroy', [DashboardKulinerController::class, 'destroy'])->middleware('auth')->middleware('admin');
Route::get('/dashboard/kuliner/create', function(){
    return view('Dashboard.kuliner.create', [
        'categories' => Category::all()
    ]);
})->middleware('auth')->middleware('admin');
Route::resource('/dashboard/kuliner', DashboardKulinerController::class)->middleware('auth')->middleware('admin');
Route::get('/dashboard/home', function(){
    $user = Auth::user();
    return view('Dashboard.home', [
        'user'=>$user
    ]);
})->middleware('auth')->middleware('admin');



