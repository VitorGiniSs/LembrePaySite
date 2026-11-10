<?php
use App\Http\Controllers\RecurrenceController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationChannelController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::delete('/notifications/{channel}', [NotificationChannelController::class, 'destroy'])
    ->name('notifications.destroy');

    Route::patch('/notifications/{channel}/toggle', [NotificationChannelController::class, 'toggle'])
    ->name('notifications.toggle');

    Route::get('/notifications', [NotificationChannelController::class, 'index'])
    ->name('notifications.index');

    Route::put('/notifications/{channel}', [NotificationChannelController::class, 'update'])
    ->name('notifications.update');
    
    Route::get('/notifications/{channel}/edit', [NotificationChannelController::class, 'edit'])
    ->name('notifications.edit');

    Route::get('/notifications/create', function () {
    return view('notifications.create');
})->name('notifications.create');
    
    Route::post('/notifications', [NotificationChannelController::class, 'store'])
    ->name('notifications.store');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
    
    Route::get('/bills/create/avulsa/status', function () {
    return view('bills.choose-avulsa-status');
})->name('bills.create.avulsa.status');

Route::get('/bills/create/avulsa', [BillController::class, 'createAvulsa'])
    ->name('bills.create.avulsa');

Route::resource('bills', BillController::class);
Route::resource('recurrences', RecurrenceController::class);
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
