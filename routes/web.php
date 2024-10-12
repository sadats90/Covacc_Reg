<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VaccinationController;

Route::get('/', function () {return view('search');});
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');


Route::get('/search', [SearchController::class, 'show'])->name('search');
Route::post('/search', [SearchController::class, 'search']);




Route::get('/schedule-vaccinations', [VaccinationController::class, 'scheduleVaccinations']);
