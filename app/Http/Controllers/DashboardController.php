<?php

namespace App\Http\Controllers;

use App\Models\actividades;
use App\Models\proyectos;
use App\Models\personals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Administrador')) {
            return $this->adminDashboard();
        } else {
            return $this->userDashboard();
        }
    }

    /**
     * Dashboard para Administradores
     */
    private function adminDashboard()
    {
        // Estadísticas generales de proyectos
        $totalProyectos = proyectos::count();
        $proyectosFinalizados = proyectos::where('estado', 3)->count();
        $proyectosEnCurso = proyectos::where('estado', 2)->count();
        $proyectosPendientes = proyectos::where('estado', 1)->count();

        // Promedio de avance global
        $promedioAvanceProyectos = proyectos::avg('avance') ?? 0;

        // Estadísticas de actividades
        $totalActividades = actividades::count();
        $actividadesFinalizadas = actividades::where('estado', 3)->count();
        $actividadesEnCurso = actividades::where('estado', 2)->count();
        $actividadesPendientes = actividades::where('estado', 1)->count();

        // Promedio de avance de actividades
        $promedioAvanceActividades = actividades::avg('avance') ?? 0;

        // Proyectos por área
        $proyectosPorArea = proyectos::join('vs_areas', 'proyectos.area', '=', 'vs_areas.id')
            ->select('vs_areas.nombre', \DB::raw('COUNT(*) as total'))
            ->groupBy('vs_areas.nombre')
            ->get();

        // Proyectos por usuario (propietario) - desde tabla personals
        $proyectosPorUsuario = DB::table('proyectos')
            ->join('users', 'proyectos.user_id', '=', 'users.id')
            ->join('personals', 'users.personal_id', '=', 'personals.id')
            ->select(
                DB::raw("CONCAT(personals.nombres, ' ', personals.apellidos) as nombre"),
                DB::raw('COUNT(DISTINCT proyectos.id) as total'),
                DB::raw('SUM(CASE WHEN proyectos.estado = 3 THEN 1 ELSE 0 END) as finalizados')
            )
            ->groupBy('personals.id', 'personals.nombres', 'personals.apellidos')
            ->get();

        // Actividades con bajo avance (menos del 50%)
        $actividadesBajoAvance = actividades::where('avance', '<', 50)
            ->with('proyectos')
            ->orderBy('avance')
            ->take(5)
            ->get();

        // Proyectos con mayor avance
        $proyectosDestacados = proyectos::orderBy('avance', 'desc')
            ->take(5)
            ->with(['user' => function($query) {
                $query->with('personal');
            }, 'areas'])
            ->get();

        // Distribucion de prioridades
        $prioridadesPoryecto = proyectos::join('vs_prioridades', 'proyectos.prioridad', '=', 'vs_prioridades.id')
            ->select('vs_prioridades.nombre', \DB::raw('COUNT(*) as total'))
            ->groupBy('vs_prioridades.id', 'vs_prioridades.nombre')
            ->get();

        return view('dashboard.admin', compact(
            'totalProyectos',
            'proyectosFinalizados',
            'proyectosEnCurso',
            'proyectosPendientes',
            'promedioAvanceProyectos',
            'totalActividades',
            'actividadesFinalizadas',
            'actividadesEnCurso',
            'actividadesPendientes',
            'promedioAvanceActividades',
            'proyectosPorArea',
            'proyectosPorUsuario',
            'actividadesBajoAvance',
            'proyectosDestacados',
            'prioridadesPoryecto'
        ));
    }

    /**
     * Dashboard para Usuarios Normales
     */
    private function userDashboard()
    {
        $userId = Auth::id();

        // Estadísticas de proyectos del usuario
        $totalProyectos = proyectos::where('user_id', $userId)->count();
        $proyectosFinalizados = proyectos::where('user_id', $userId)->where('estado', 3)->count();
        $proyectosEnCurso = proyectos::where('user_id', $userId)->where('estado', 2)->count();
        $proyectosPendientes = proyectos::where('user_id', $userId)->where('estado', 1)->count();

        // Promedio de avance de proyectos
        $promedioAvanceProyectos = proyectos::where('user_id', $userId)->avg('avance') ?? 0;

        // Estadísticas de actividades asignadas al usuario
        $totalActividades = actividades::whereIn('proyecto_id',
            proyectos::where('user_id', $userId)->pluck('id')
        )->count();

        $actividadesFinalizadas = actividades::whereIn('proyecto_id',
            proyectos::where('user_id', $userId)->pluck('id')
        )->where('estado', 3)->count();

        $actividadesEnCurso = actividades::whereIn('proyecto_id',
            proyectos::where('user_id', $userId)->pluck('id')
        )->where('estado', 2)->count();

        $actividadesPendientes = actividades::whereIn('proyecto_id',
            proyectos::where('user_id', $userId)->pluck('id')
        )->where('estado', 1)->count();

        // Promedio de avance de actividades
        $promedioAvanceActividades = actividades::whereIn('proyecto_id',
            proyectos::where('user_id', $userId)->pluck('id')
        )->avg('avance') ?? 0;

        // Proyectos destacados del usuario
        $proyectosDestacados = proyectos::where('user_id', $userId)
            ->orderBy('avance', 'desc')
            ->take(5)
            ->with('areas')
            ->get();

        // Actividades próximas a vencer (ordenadas por fecha estimada)
        $actividadesProximas = actividades::whereIn('proyecto_id',
            proyectos::where('user_id', $userId)->pluck('id')
        )->where('estado', '!=', 3)
            ->orderBy('fecha_estimada')
            ->take(5)
            ->with('proyectos')
            ->get();

        // Actividades con bajo avance
        $actividadesBajoAvance = actividades::whereIn('proyecto_id',
            proyectos::where('user_id', $userId)->pluck('id')
        )->where('avance', '<', 50)
            ->orderBy('avance')
            ->take(5)
            ->with('proyectos')
            ->get();

        // Distribución por área
        $proyectosPorArea = proyectos::where('user_id', $userId)
            ->join('vs_areas', 'proyectos.area', '=', 'vs_areas.id')
            ->select('vs_areas.nombre', \DB::raw('COUNT(*) as total'))
            ->groupBy('vs_areas.id', 'vs_areas.nombre')
            ->get();

        return view('dashboard.user', compact(
            'totalProyectos',
            'proyectosFinalizados',
            'proyectosEnCurso',
            'proyectosPendientes',
            'promedioAvanceProyectos',
            'totalActividades',
            'actividadesFinalizadas',
            'actividadesEnCurso',
            'actividadesPendientes',
            'promedioAvanceActividades',
            'proyectosDestacados',
            'actividadesProximas',
            'actividadesBajoAvance',
            'proyectosPorArea'
        ));
    }
}
