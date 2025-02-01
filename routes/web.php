<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'companies'], function () {
    Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/{company}', [CompanyController::class, 'show'])->name('companies.show');
    Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::put('/{company}', [CompanyController::class, 'update'])->name('companies.update');
    Route::get('/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('companies.delete');
});
Route::group(['prefix' => 'employees'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::post('/', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('employees.delete');
});
