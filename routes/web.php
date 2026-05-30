<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CaregiversController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect('redirect');
    }
    return view('user/home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('redirect', [HomeController::class, 'redirect']);

    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}/payment', [BookingController::class, 'payment'])->name('booking.payment');
    Route::post('/booking/{booking}/pay', [BookingController::class, 'pay'])->name('booking.pay');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin-profile', function () {
        return view('Admin/AdminProfile');
    });

    Route::put('/admin-profile', [ProfileController::class, 'updateAdminProfile'])
        ->name('admin.profile.update');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile');

    Route::patch('/profile/update-custom', [ProfileController::class, 'update'])
        ->name('profile.update.custom');

    Route::put('/profile/password-update', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');
});
    
Route::get('about', function () {
    return view('user.pages.about');
});
Route::get('contact', function () {
    return view('user.pages.conatct');
});

Route::get('services', function () {
    return view('user.pages.services');
});

Route::controller(CaregiversController::class)->group(function () {
    Route::get('caregivers', 'allCaregivers')->name('allCaregivers');

    Route::patch('/caregivers/{id}/status', 'updateStatus')
        ->name('caregivers.status');

    Route::get('medicalcaregivers', 'medical')
        ->name('caregivers.medical');

    Route::get('/caregivers/create', 'create')->name('caregivers.create');

    Route::post('/caregivers', 'store')->name('caregivers.store');

    Route::get('/caregivers/{caregiver}/edit', 'edit')->name('caregivers.edit');

    Route::put('/caregivers/{caregiver}', 'update')->name('caregivers.update');

    Route::get('caringcaregivers', 'caring')
        ->name('caring.caregivers');

    Route::get('/caregiver/{id}', 'show')
        ->name('caregiver.show');
});
// web.php




Route::controller(CustomersController::class)->group(function () {

    Route::get('customers', 'allCustomers')->name('allCustomers');

    Route::get('/customers/create', 'create')->name('customers.create');
    Route::post('/customers', 'store')->name('customers.store');

    Route::get('/customers/{customer}/edit', 'edit')->name('customers.edit');
    Route::put('/customers/{customer}', 'update')->name('customers.update');

    Route::delete('/customers/{customer}', 'destroy')
        ->middleware('auth')
        ->name('customers.destroy');
});
