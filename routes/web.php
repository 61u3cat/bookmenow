<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard', fn() => 'Admin Dashboard');
// });

// Route::middleware(['auth', 'role:provider'])->group(function () {
//     Route::get('/provider/dashboard', fn() => 'Provider Dashboard');
// });
Route::middleware(['auth', 'role:provider'])->prefix('provider')->name('provider.')->group(function () {
    Route::resource('services', App\Http\Controllers\Provider\ServiceController::class);
});

// Payment routes
Route::middleware(['auth'])->group(function () {
    Route::get('/payment/checkout/{booking}', [App\Http\Controllers\PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
});

// Stripe webhook
Route::post('/stripe/webhook', [App\Http\Controllers\PaymentController::class, 'handleWebhook'])->name('stripe.webhook');
// Route::middleware(['auth', 'role:provider'])->group(function () {
// Route::middleware(['auth'])->group(function () {
//     Route::get('/provider/test', fn() => 'Testing Route');
// });
// Public Booking Routes (no auth required)
Route::middleware('auth')->prefix('book')->name('book.')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('index'); // service list
    Route::get('/{service}', [BookingController::class, 'show'])->name('show'); // service detail
    Route::post('/{service}', [BookingController::class, 'store'])->name('store'); // submit booking
});
Route::middleware(['auth', 'role:provider'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/bookings', [App\Http\Controllers\Provider\BookingController::class, 'index'])->name('bookings.index');
});
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

        // Admin managing providers, services, and bookings
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
        Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class);
    });
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/services', [BookingController::class, 'index'])->name('services');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my-bookings');
    // You can add a dashboard or services page here as well
});

// Publicly viewable services and booking form (but booking POST should be protected)
Route::get('/services', [BookingController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [BookingController::class, 'show'])->name('services.show');
Route::post('/services/{service}', [BookingController::class, 'store'])
    ->middleware(['auth', 'role:customer'])
    ->name('services.book');

Route::middleware(['auth', 'role:provider'])->group(function () {
    Route::get('/subscribe', [App\Http\Controllers\SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('/subscribe', [App\Http\Controllers\SubscriptionController::class, 'store'])->name('subscription.store');
});

require __DIR__ . '/auth.php';
