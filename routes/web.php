<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('projects', ProjectController::class);

    Route::resource('partners', PartnerController::class);
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('projects', [UserController::class, 'listProjects'])->name('projects.list');

    Route::get('projects/{project}', [UserController::class, 'showProject'])->name('projects.show');

    Route::post('/projects/{project}/request-join', [ProjectController::class, 'requestJoin'])->name('projects.requestJoin');


});

