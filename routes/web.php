<?php

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
 
 

Auth::routes();
Route::middleware(['auth'])->group(function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/code', App\Http\Livewire\code\index::class)->name('code');  
Route::get('/code/create', App\Http\Livewire\code\create::class)->name('code.create');

Route::get('/backups', App\Http\Livewire\backup\index::class)->name('backups');
    Route::get('/backups/download/{file_name}', [App\Http\Controllers\BackupController::class, 'download']
    )->name("backups.download") ;
    Route::get('/Backup/delete/{file_name}', [App\Http\Controllers\BackupController::class, 'delete']
    )->name("backups.delete") ;
});
