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
})->name('home');

Route::get('/register', [AuthController::class, 'showRegistrationForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(["isLoggedIn","isAdmin"])->group(function () {
    Route::resource('projects', ProjectController::class);

    Route::resource('partners', PartnerController::class);

    Route::get('/requests', [ProjectController::class, 'listRequests'])->name('admin.requests.index');
    Route::put('/requests/{joinRequest}', [ProjectController::class, 'updateRequestStatus'])->name('requests.update');

});

Route::prefix('user')->name('user.')->middleware(["isLoggedIn"])->group(function () {
    Route::get('projects', [UserController::class, 'listProjects'])->name('projects.list');

    Route::get('projects/{project}', [UserController::class, 'showProject'])->name('projects.show');

    Route::post('/projects/{project}/request-join', [ProjectController::class, 'requestJoin'])->name('projects.requestJoin');

});


