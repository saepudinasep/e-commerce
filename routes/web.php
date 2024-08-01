<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Models\Products;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::get('/', function () {
    $products = Products::orderBy('rating', 'desc') // Mengurutkan berdasarkan rating, dari yang tertinggi
        ->take(6) // Mengambil 6 produk teratas
        ->get(); // Mengeksekusi query
    return view('home', compact('products'));
});


// Halaman Utama dan Produk
Route::get('/product', [ProductsController::class, 'index'])->name('product');
Route::get('/product/{id}', [ProductsController::class, 'show'])->name('product.show');
