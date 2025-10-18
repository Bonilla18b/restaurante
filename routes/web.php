<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*use App\Http\Controllers\UserController;
Route::get('/users', [UserController::class, 'index']); */

/*Route::get('/about', function () {return 'Acerca de nosotros';}); 

Route::get('/user/{id}', function ($id) {return 'ID de usuario: ' . $id;});

Route::get('/contacto', function () {return 'Página de contacto';})->name('contacto');

Route::get('/user/{id}', function ($id) {return 'ID de usuario: ' . $id;})->where('id', '[0-9]{3}');

Route::prefix('admin')->group(function () {
Route::get('/', function () {return 'Panel de administración';});
Route::get('/users', function () {return 'Lista de usuarios';});});/* 
//--------------------------------------------------- Ejercicio---------------------------------------*/


Route::get('/producto', function () {return 'Aqui productos';}); //cambiar esto