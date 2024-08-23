<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
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

/*
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request) {
    if ($request->user()->markEmailAsVerified()) {
        event(new Verified($request->user()));
    }
    return redirect('/')->with('verified', true);
})->middleware(['auth', 'signed'])->name('verification.verify');
*/

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
Route::get('/thanks', function () {
    return view('auth.thanks');
})->name('thanks');

Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);

    Route::post('/done', [ReserveController::class, 'store']);
    Route::delete('/mypage/delete/{reservation}', [ReserveController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/reserve/edit/{id}', [ReserveController::class, 'edit'])->name('reserve.edit');
    Route::put('/reserve/update/{id}', [ReserveController::class, 'update'])->name('reserve.update');


    Route::get('/mypage', [PersonalController::class, 'index']);

    Route::get('/detail/{store_id}', [StoreController::class, 'show'])->name('store.detail');
    Route::post('/stores/{store}/favorite', [StoreController::class, 'like'])->name('store.favorite');

    Route::get('/stores/{store}/reviews', [ReviewController::class, 'index'])->name('reviews.create');
    Route::post('/stores/{store}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});