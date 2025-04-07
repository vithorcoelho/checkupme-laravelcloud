<?php

require __DIR__ . '/auth.php';

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/**
 * Público
*/

Route::get('/', App\Livewire\Public\Home\HomeIndex::class)->name('home');
Route::get('@{slug?}', App\Livewire\Public\Profile\ProfileIndex::class)->name('public.profile');

Route::group(['middleware' => ['auth'], 'prefix' => 'painel'], function(){

    /**
     * Profissionais
    */
    Route::group(['middleware' => ['role:profissional']],function () {
        Route::get('profile', App\Livewire\App\Professional\Profile\ProfileIndex::class)->name('profile');
        Route::get('addresses', App\Livewire\App\Professional\Address\AddressIndex::class)->name('addresses.index');
        Route::get('addresses/create', App\Livewire\App\Professional\Address\AddressCreate::class)->name('addresses.create');
        Route::get('addresses/{address_id}/edit', App\Livewire\App\Professional\Address\AddressEdit::class)->name('addresses.edit');
    });

    /**
     * Administradores
    */
    Route::group(['middleware' => ['role:admin']], function () {
        //Route::view('usuarios', 'livewire.app.admin.user.user-index')->name('usuarios');
        Route::get('usuarios', App\Livewire\App\Admin\User\UserIndex::class)->name('usuarios');
        Route::view('usuarios.create', 'livewire.app.admin.user.create')->name('usuarios.create');
    });

    /**
     * Rotas compartilhadas administradores e usuários
    */
    Route::view('dashboard', 'livewire.app.professional.dashboard.index')->name('dashboard');
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'private.settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'private.settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'private.settings.appearance')->name('settings.appearance');
});
