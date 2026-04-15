<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAuth;

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

Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page');




Route::middleware('isAuth')->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

      Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('isAdmin')->group(function () {


        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        
        Route::get('/items', [ItemController::class, 'index'])->name('admin.items.index');
        Route::get('/items/create', [ItemController::class, 'create'])->name('admin.items.create');
        Route::post('/items', [ItemController::class, 'store'])->name('admin.items.store');
        Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('admin.items.edit');
        Route::put('/items/{item}', [ItemController::class, 'update'])->name('admin.items.update');
        Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('admin.items.destroy');
        Route::get('/items/{item}/lending', [ItemController::class, 'lendings'])->name('admin.items.lendings');
        Route::get('/items/export', [ItemController::class, 'export'])->name('admin.items.export');

         Route::get('/users/admins', [UserController::class, 'adminIndex'])->name('admin.users.admins');
        Route::get('/users/operators', [UserController::class, 'operatorIndex'])->name('admin.users.operators');
        Route::get('/users/admins/export', [UserController::class, 'exportAdmins'])->name('admin.users.export_admins');
        Route::get('/users/operators/export', [UserController::class, 'exportOperators'])->name('admin.users.export_operators');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.reset_password');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    Route::middleware('isStaff')->group(function() {

        Route::get('/staff/items', [ItemController::class, 'staffIndex'])->name('staff.items.index');

        Route::get('/lendings/export', [LendingController::class, 'export'])->name('staff.lendings.export');
        Route::get('/lendings', [LendingController::class, 'index'])->name('staff.lendings.index');
        Route::get('/lendings/create', [LendingController::class, 'create'])->name('staff.lendings.create');
        Route::post('/lendings', [LendingController::class, 'store'])->name('staff.lendings.store');
        Route::post('/lendings/{lending}', [LendingController::class, 'returnItem'])->name('staff.lendings.return');
        Route::delete('/lendings/{lending}', [LendingController::class, 'destroy'])->name('staff.lendings.destroy');
    });

    
});

