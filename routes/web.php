<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\PostController;

// Redirect root to login if not authenticated, otherwise to welcome
Route::get('/', function () {
    if (auth()->check()) {
        return view('welcome');
    }
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes (User Only)
Route::get('/register/user', [RegisterController::class, 'showUserForm'])->name('register.user');
Route::post('/register/user', [RegisterController::class, 'registerUser']);

// Protected Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminUsersController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}', [AdminUsersController::class, 'show'])->name('admin.users.show');
    Route::delete('/admin/users/{user}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
});

// Password management for both admin and user
Route::middleware('auth')->group(function () {
    Route::get('/password/change', [App\Http\Controllers\PasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/update', [App\Http\Controllers\PasswordController::class, 'updatePassword'])->name('password.update');
});

// Add a general dashboard route that redirects based on role
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->name('dashboard');

// Posts Resource Routes (CRUD)
Route::middleware('auth')->resource('posts', PostController::class);

// Services Routes (Customer)
Route::middleware('auth')->group(function () {
    Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service}/book', [App\Http\Controllers\ServiceController::class, 'book'])->name('services.book');
    Route::post('/services/{service}/book', [App\Http\Controllers\ServiceController::class, 'storeBooking'])->name('services.store-booking');
    Route::get('/my-bookings', [App\Http\Controllers\ServiceController::class, 'myBookings'])->name('my.bookings');
    Route::post('/bookings/{booking}/cancel', [App\Http\Controllers\ServiceController::class, 'cancelBooking'])->name('bookings.cancel');
});

// Contact Routes
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('admin.contacts.index');
    Route::post('/admin/contacts/{contact}/read', [App\Http\Controllers\ContactController::class, 'markRead'])->name('admin.contacts.read');
    Route::delete('/admin/contacts/{contact}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('admin.contacts.destroy');
});

// Services Routes (Admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/services', [App\Http\Controllers\ServiceController::class, 'adminIndex'])->name('admin.services.index');
    Route::get('/admin/services/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('/admin/services', [App\Http\Controllers\ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('/admin/services/{service}/edit', [App\Http\Controllers\ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('/admin/services/{service}', [App\Http\Controllers\ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/admin/services/{service}', [App\Http\Controllers\ServiceController::class, 'destroy'])->name('admin.services.destroy');
    Route::get('/admin/bookings', [App\Http\Controllers\ServiceController::class, 'adminBookings'])->name('admin.bookings');
    Route::post('/admin/bookings/{booking}/status', [App\Http\Controllers\ServiceController::class, 'updateBookingStatus'])->name('admin.bookings.status');
});

