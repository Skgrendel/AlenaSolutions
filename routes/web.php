<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonalsController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();
Route::middleware('check_user_status')->group(function () {
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/vixor',[ReportController::class,'vixor'])->name('Rerpotevixor');
Route::get('/operaciones',[ReportController::class,'operacion'])->name('ReportOperaciones');
Route::get('/qanalytic',[ReportController::class,'qanalytic'])->name('ReportQanalytic');
Route::resource('personals', PersonalsController::class)->names('personals');
});
