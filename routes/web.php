<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
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

//rotte pubbliche (ci si può accedere senza essere loggati)
Route::get('/', function () {
    return view('welcome');
});

//tutte le rotte protette da autenticazione (NON ci si può accedere senza essere loggati)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    //crea tutte le rotte CRUD per la risorsa 'projects' 
    Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']); 
    Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug']); 

    //per ora commento queste rotte perchè non mi devo ancora occupare della gestione del profilo
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

//tutte le rotte di autenticazione(registrazione, login, ecc...)
require __DIR__.'/auth.php';
