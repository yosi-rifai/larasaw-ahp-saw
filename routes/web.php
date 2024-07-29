<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelPageController;
use App\Http\Controllers\AlternativeController;

Route::get('/',  [HomepageController::class, 'index'])->name('homepage');
Route::post('/send-email', [HomepageController::class, 'sendEmail'])->name('sendEmail');
Route::get('/hotelspage', [HotelPageController::class, 'index'])->name('hotelspage.index');
Route::get('about', [HotelPageController::class, 'about'])->name('about-us');
Route::get('hotel-blog-detail/{id}', [HotelPageController::class, 'show'])->name('hotel-blog-detail');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('hotels', HotelController::class);
    Route::resource('criterias', CriteriaController::class);
    Route::resource('alternatives', AlternativeController::class);
    Route::resource('rankings', RankingController::class);

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('detail', [HotelController::class, 'detail'])->name('hotels.detail');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('web');
});
