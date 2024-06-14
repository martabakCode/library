<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
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
})->name('landingpage');

Route::resource('admin/users', UserController::class)->middleware('admin');

Route::get('books/request', [BookController::class, 'borrowApproval'])->name('books.borrowApproval');
Route::post('/books/{book}/borrow-request', [BookController::class, 'borrowRequest'])->name('books.borrowRequest')->middleware('auth');
Route::post('/books/request/{request}/approve', [BookController::class, 'borrowApprove'])->name('books.borrowApprove');
Route::get('books', [BookController::class, 'index'])->name('books.index')->middleware('admin');
Route::get('books/create', [BookController::class, 'create'])->name('books.create')->middleware('admin');
Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');

Route::post('books', [BookController::class, 'store'])->name('books.store')->middleware('admin');
Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit')->middleware('admin');
Route::put('books/{book}', [BookController::class, 'update'])->name('books.update')->middleware('admin');
Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy')->middleware('admin');

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('admin');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('admin');
Route::get('categories/{category}/books', [CategoryController::class, 'show'])->name('categories.show');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('admin');
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('admin');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update')->middleware('admin');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('admin');
Route::middleware('auth')->group(function () {


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::get('categories/{category}/books', [CategoryController::class, 'show'])->name('categories.books');
});



require __DIR__.'/auth.php';
