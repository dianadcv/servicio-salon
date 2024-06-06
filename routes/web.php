<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\SalonUsersController;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use App\Http\Controllers\RentaSalonController;

Route::get('/', HomeController::class)->name('home');

Route::controller(SalonController::class)->group(function () {
    Route::get('back', 'goBack')->name('salones.goBack');
    Route::get('salones/{users}', 'index')->name('salones.index');
    Route::get('salones/{users}/create', 'create')->name('salones.create');
    Route::post('salones/{users}', 'store')->name('salones.store');
    Route::get('salones/{users}/mine', 'mine')->name('salones.mine');
    Route::get('salones/{users}/{salon}', 'show')->name('salones.show');
    Route::get('salones/{users}/{salon}/edit', 'edit')->name('salones.edit');
    Route::put('salones/{users}/{salon}', 'update')->name('salones.update');
    Route::get('salones/delete/{users}/{id}', 'delete')->name('salones.delete');  
});

Route::controller(SalonUsersController::class)->group(function () {
    Route::get('registrar', 'registrar')->name('users.registrar');
    Route::post('registrar/create', 'create')->name('users.create');
    Route::post('registrar/check', 'check')->name('users.check');
    Route::get('user/{id}', 'show')->name('users.show');
    Route::put('user/edit/{id}', 'update')->name('users.update');
    Route::get('user/delete/{id}', 'delete')->name('users.delete');
});

Route::controller(RentaSalonController::class)->group(function () {
    Route::post('renta/registrar/{users}', 'create')->name('renta.create');
    Route::get('renta/show/{users}', 'show')->name('renta.show');
    Route::get('renta/edit/{renta}', 'edit')->name('renta.edit');
    Route::post('renta/upload/{id}', 'upload')->name('renta.upload');
    Route::get('renta/delete/{id}', 'delete')->name('renta.delete');
    Route::get('renta/pdf/{id}', 'pdf')->name('renta.pdf');
});
