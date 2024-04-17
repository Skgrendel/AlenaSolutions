<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonalsController;
use App\Http\Controllers\ProyectosController;
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
Route::get('/reportes',[ReportController::class,'index'])->name('Rerpoteindex');
Route::get('/operaciones',[ReportController::class,'operacion'])->name('ReportOperaciones');
Route::get('/qanalytic',[ReportController::class,'qanalytic'])->name('ReportQanalytic');
Route::get('/proderi',[ReportController::class,'proderiIndex'])->name('proderiIndex');
Route::get('/proderi/datos',[ReportController::class,'proderiAdatos'])->name('proderiAdatos');
Route::get('/proderi/administrativo',[ReportController::class,'proderiAdministrativo'])->name('proderiAdmi');
Route::get('/proderi/administrativo/compras',[ReportController::class,'proderiAdministrativocompras'])->name('prodericompras');
Route::get('/proderi/administrativo/permisos',[ReportController::class,'proderiAdministrativopermisos'])->name('proderipermisos');
Route::get('/proderi/departamentoit',[ReportController::class,'proderidepartamentoit'])->name('departamentoit');
Route::get('/proderi/departamentoit/soporte',[ReportController::class,'proderidepartamentoitsoporte'])->name('itsoporte');
Route::resource('personals', PersonalsController::class)->names('personals');
Route::resource('proyectos', ProyectosController::class)->names('proyectos');
});
