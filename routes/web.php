<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
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

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    $products = Products::orderBy('rating', 'desc') // Mengurutkan berdasarkan rating, dari yang tertinggi
        ->take(6) // Mengambil 6 produk teratas
        ->get(); // Mengeksekusi query
    return view('home', compact('products'));
});


Route::middleware(['auth'])->group(function () {
    // Halaman Produk
    Route::get('/product', [ProductsController::class, 'index'])->name('product');
    Route::get('/product/{id}', [ProductsController::class, 'show'])->name('product.show');

    // Keranjang Belanja
    Route::get('/cart', [CartsController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartsController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{itemId}', [CartsController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{itemId}', [CartsController::class, 'remove'])->name('cart.remove');

    // Order
    Route::get('/order/{id}', [OrdersController::class, 'show'])->name('order.show');
    // Route::get('/order/status/{id}', [OrdersController::class, 'status'])->name('order.status');
    Route::get('/invoice/{id}', [OrdersController::class, 'invoice']);
    Route::get('/belum-bayar', [OrdersController::class, 'belum_bayar'])->name('order.belum-bayar');
    Route::get('/dikemas', [OrdersController::class, 'dikemas'])->name('order.dikemas');
    Route::get('/dikirim', [OrdersController::class, 'dikirim'])->name('order.dikirim');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/checkout/{id}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});
