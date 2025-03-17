<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\HocPhanController;
use App\Http\Controllers\DangKyController;
use App\Http\Controllers\AuthController;

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
Route::resource('sinhviens', SinhVienController::class);

Route::get('/hocphans', [HocPhanController::class, 'index'])->name('hocphans.index');
Route::post('/dangky/{MaHP}', [DangKyController::class, 'store'])->name('dangky.store');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dangky', [DangKyController::class, 'index'])->name('dangky.index');

    Route::get('/cart', [DangKyController::class, 'cart'])->name('cart');
    Route::post('/cart/add/{MaHP}', [DangKyController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{MaHP}', [DangKyController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/checkout', [DangKyController::class, 'checkout'])->name('cart.checkout');

    Route::delete('/dangky/{MaHP}', [DangKyController::class, 'destroy'])->name('dangky.destroy');
    Route::delete('/dangky/xoa-tat-ca', [DangKyController::class, 'destroyAll'])->name('dangky.destroyAll');
    Route::post('/dangky/luu', [DangKyController::class, 'luuDangKy'])->name('dangky.luu');

});