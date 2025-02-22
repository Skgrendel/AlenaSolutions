<?php

use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\FuntionController;
use App\Http\Controllers\GrupodiagnosticoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonalsController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\RegisterPersonalsController;
use App\Http\Controllers\ReportController;
use App\Models\actividades;
use App\Models\diagnostico;
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

Route::get('/registrarse',[RegisterPersonalsController::class,'index'])->name('Registrarse');
Route::post('/registrarse',[RegisterPersonalsController::class,'store'])->name('Registrarse.store');
Auth::routes();
Route::middleware('check_user_status')->group(function () {
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/vixor',[ReportController::class,'vixor'])->name('Rerpotevixor');
Route::get('/reportes',[ReportController::class,'index'])->name('Rerpoteindex');
Route::get('/operaciones',[ReportController::class,'operacion'])->name('ReportOperaciones');
Route::get('/qanalytic',[ReportController::class,'qanalytic'])->name('ReportQanalytic');
Route::get('/qanalyticsincelejo',[ReportController::class,'qanalyticsincelejo'])->name('ReportQanalyticsincelejo');
Route::get('/ventas',[ReportController::class,'ventas'])->name('Reportventas');
Route::get('/proderi',[ReportController::class,'proderiIndex'])->name('proderiIndex');
Route::get('/proderi/gestion',[ReportController::class,'proderiGestion'])->name('proderiGestion');
Route::get('/proderi/debidadiligencia',[ReportController::class,'debidadiligencia'])->name('proderidebidadiligencia');
Route::get('/proderi/administrativo',[ReportController::class,'proderiAdministrativo'])->name('proderiAdmi');
Route::get('/proderi/administrativo/compras',[ReportController::class,'proderiAdministrativocompras'])->name('prodericompras');
Route::get('/proderi/administrativo/permisos',[ReportController::class,'proderiAdministrativopermisos'])->name('proderipermisos');
Route::get('/proderi/departamentoit',[ReportController::class,'proderidepartamentoit'])->name('departamentoit');
Route::get('/acoficum',[ReportController::class,'acoficum'])->name('acoficum');
Route::get('/proderi/departamentoit/soporte',[ReportController::class,'proderidepartamentoitsoporte'])->name('itsoporte');
Route::resource('/personals', PersonalsController::class)->names('personals');
Route::resource('/proyectos', ProyectosController::class)->names('proyectos');
Route::get('/proyectos/{proyecto}/actividades',[ProyectosController::class,'actividades'])->name('proyectos.actividades');
Route::get('/actividades/create/{id}',[ActividadesController::class,'create_activi'])->name('proyectos.create_activi');
Route::resource('/actividades',ActividadesController::class)->names('actividades');
Route::resource('/auditorias',GrupodiagnosticoController::class)->names('auditorias');
Route::resource('/diagnosticos',DiagnosticoController::class)->names('diagnosticos');
Route::resource('/Grupodiagnosticos',GrupodiagnosticoController::class)->names('Grupodiagnosticos');

});
