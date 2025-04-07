<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('login', 'public.auth.login')->name('login');
    Route::view('register', 'livewire.public.auth.choose-profile')->name('register');
    Volt::route('register/pacient', 'public.auth.register-pacient')->name('register.pacient');
    Volt::route('register/professional', 'public.auth.register-professional')->name('register.professional');
    Volt::route('forgot-password', 'public.auth.forgot-password')->name('password.request');
    Volt::route('reset-password/{token}', 'public.auth.reset-password')->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'auth.verify-email')->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Volt::route('confirm-password', 'auth.confirm-password')->name('password.confirm');
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
