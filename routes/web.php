<?php
use Illuminate\Support\Facades\Route;
use App\Models\Time;

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
    $timings = Time::all();
    return view('welcome', ["timings" => $timings]);
});

Auth::routes();

Route::get('/board', [App\Http\Controllers\HomeController::class, 'show'])->name('board');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/pull-data-from-monday', [App\Http\Controllers\BoardController::class, 'store'])->name('generate');
Route::post('/pull-data', [App\Http\Controllers\ActivityController::class, 'store'])->name('activity');
Route::get('/export-to-excel', [App\Http\Controllers\TimeController::class, 'export'])->name('export');

