<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/author',[AuthorController::class, 'index'])->name('author.index');
Route::post('/author',[AuthorController::class, 'store'])->name('author.store');
Route::get('/author/{author}',[AuthorController::class, 'show'])->name('author.show');

Route::put('/author/{author}',[AuthorController::class, 'update'])->name('author.update');
Route::delete('/author/{author}',[AuthorController::class, 'destroy'])->name('author.destroy');