<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CivController;
use App\Http\Controllers\CompagnyController;
use App\Http\Controllers\CreController;
use App\Http\Controllers\DisponibilityController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NextStepController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SpecialityController;

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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DasboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::get('roles-permissions', [RolePermissionController::class, 'index'])->name('roles.permissions');
    Route::resource('roles', RoleController::class);
    Route::resource('candidates', CandidateController::class);
    Route::get('import-candidat', [CandidateController::class, 'import'])->name('import.candidat');
    Route::resource('positions', PositionController::class);
    Route::resource('specialities', SpecialityController::class);
    Route::resource('fields', FieldController::class);
    Route::resource('compagnies', CompagnyController::class);
    Route::resource('disponibilities', DisponibilityController::class);
    Route::resource('civs', CivController::class);
    Route::get('user-profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('add-cre/{candidate}/{action}', [CreController::class, 'form'])->name('add.cre');
    Route::get('summary', [DasboardController::class, 'summary'])->name('summary');
    Route::get('detail', [DasboardController::class, 'detail'])->name('detail');
    Route::get('state/{state}', [CandidateController::class, 'state'])->name('state');
    Route::resource('nextsteps', NextStepController::class);
    Route::get('candidate-cre/{candidate}', [CreController::class, 'candidateCre'])->name('candidate.cre');

    // Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
Route::get('commandes/{param}', [DasboardController::class, 'commande']);
