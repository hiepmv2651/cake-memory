<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'usertype'])->group(function () {
    Route::get('/view_category', [AdminController::class, 'view_category'])->middleware('verified');

    Route::post('/add_category', [AdminController::class, 'add_category']);
    
    Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);
    
    Route::get('/view_product', [AdminController::class, 'view_product']);
    
    Route::post('/add_product', [AdminController::class, 'add_product']);
    
    Route::get('/show_product', [AdminController::class, 'show_product']);
    
    Route::get('/update_product/{id}', [AdminController::class, 'update_product']);
    
    Route::post('/edit_product/{id}', [AdminController::class, 'edit_product']);
    
    Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
    
    Route::get('/order', [AdminController::class, 'order']);
    
    Route::get('/delivery/{id}', [AdminController::class, 'delivery']);
    
    Route::get('/send_email/{id}', [AdminController::class, 'send_email']);
    
    Route::post('/send_user_email/{id}', [AdminController::class, 'send_user_email']);
    
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/redirect', [HomeController::class, 'redirect']);

    Route::get('/product_details/{id}', [HomeController::class, 'products_detail']);

    Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);

    Route::get('/show_cart', [HomeController::class, 'show_cart']);

    Route::get('/delete_cart/{id}', [HomeController::class, 'delete_cart']);

    Route::delete('/delete_select', [HomeController::class, 'delete_select']);

    Route::delete('/cash_order', [HomeController::class, 'cash_order']);

    Route::delete('/stripe', [HomeController::class, 'stripe']);

    Route::post('/stripe/{totalprice}', [HomeController::class, 'stripePost'])->name('stripe.post');

    Route::get('/show_order', [HomeController::class, 'show_order']);

    Route::get('/order_details/{id}', [HomeController::class, 'order_details']);

    Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);

    Route::get('/product_search', [HomeController::class, 'product_search']);

    Route::get('/product', [HomeController::class, 'product']);

    Route::get('/search_product', [HomeController::class, 'search_product']);
});