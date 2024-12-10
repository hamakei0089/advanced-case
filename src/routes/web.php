<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RepController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;

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

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
Route::get('/thanks', function () {
    return view('auth.thanks');
})->name('thanks');

Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/resend', [EmailVerificationController::class, 'resend'])->middleware('auth')->name('verification.resend');

/*user*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [StoreController::class, 'index']);
    Route::get('/detail/{store_id}', [StoreController::class, 'show'])->name('store.detail');
    Route::post('/stores/{store}/favorite', [StoreController::class, 'like'])->name('store.favorite');

    Route::post('/done', [ReservationController::class, 'store']);
    Route::delete('/mypage/delete/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/reservation/edit/{id}', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::put('/reservation/update/{id}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::get('/generate-qr-code/{id}', [ReservationController::class, 'show'])->name('qr-code.show');

    Route::get('/mypage', [PersonalController::class, 'index']);


    Route::get('/stores/{store}/reviews', [ReviewController::class, 'index'])->name('reviews.create');
    Route::post('/stores/{store}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

/*管理者*/
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'index'])->name('admin.login.index');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.login');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.login.logout');

    Route::middleware('auth:administrators')->group(function () {
        Route::get('/home', [AdminController::class, 'home'])->name('admin.home');
        Route::post('/create-representative', [AdminController::class, 'create'])->name('admin.createRepresentative');
        Route::post('/send-broadcast-email', [AdminController::class, 'sendBroadcastEmail'])->name('admin.sendBroadcastEmail');
    });
});

/*店舗代表者*/
Route::prefix('rep')->group(function () {
    Route::get('login', [RepController::class, 'index'])->name('rep.login.index');
    Route::post('login', [RepController::class, 'login'])->name('rep.login.login');
    Route::post('logout', [RepController::class, 'logout'])->name('rep.login.logout');

    Route::middleware('auth:representatives')->group(function () {
        Route::get('/home', [RepController::class, 'home'])->name('rep.home');
        Route::post('/create-store', [RepController::class, 'create'])->name('rep.createStore');
        Route::get('/detail/{store_id}', [RepController::class, 'show'])->name('rep.detail');
        Route::get('/edit/store/{store_id}', [RepController::class, 'edit'])->name('rep.edit.store');
        Route::put('/store/{store_id}', [RepController::class, 'update'])->name('rep.update.store');
        Route::delete('/store/{store_id}', [RepController::class, 'destroy'])->name('rep.delete.store');

    });
});
