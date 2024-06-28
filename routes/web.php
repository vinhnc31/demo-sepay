<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FormController::class, 'showForm'])->name('form.show');
Route::post('/order', [FormController::class, 'handleForm'])->name('form.handle');
