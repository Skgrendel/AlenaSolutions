@extends('layouts.page.dashboard')

@section('content')
    <style>
        .user-dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .user-dashboard-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }

        .stat-card-user {
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: none;
            height: 100%;
        }

        .stat-card-user:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-card-user.bg-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card-user.bg-success {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stat-card-user.bg-warning {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-card-user.bg-danger {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .stat-value-user {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin: 1rem 0;
        }

        .stat-label-user {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
        }

        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            padding: 1.5rem;
            border-radius: 10px 10px 0 0;
        }

        .card-header h3 {
            margin: 0;
            font-weight: 700;
            color: #2c3e50;
        }

        .progress {
            border-radius: 10px;
            background-color: #e9ecef;
            overflow: hidden;
        }

        .progress-bar {
            border-radius: 10px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .badge {
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>

     <div class="user-dashboard-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="user-dashboard-title">
                    <i class="fas fa-user-circle mr-2"></i>Mi Dashboard
                </h1>
                <p class="text-white mb-0">
                    <i class="fas fa-info-circle mr-2"></i>Seguimiento de tus proyectos y actividades
                </p>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ route('proyectos.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-right mr-2"></i>Ver Proyectos
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Resumen de Proyectos del Usuario -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stat-card-user bg-primary text-white">
                    <div class="card-body">
                        <div class="stat-label-user">Mis Proyectos</div>
                        <div class="stat-value-user">{{ $totalProyectos }}</div>
                        <small class="text-white">
                            <i class="fas fa-folder mr-1"></i>Proyectos Activos
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stat-card-user bg-success text-white">
                    <div class="card-body">
                        <div class="stat-label-user">Finalizados</div>
                        <div class="stat-value-user">{{ $proyectosFinalizados }}</div>
                        <small class="text-white">
                            <i class="fas fa-check-circle mr-1"></i>{{ round(($proyectosFinalizados / max($totalProyectos, 1)) * 100, 1) }}% Completados
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stat-card-user bg-warning text-white">
                    <div class="card-body">
                        <div class="stat-label-user">En Curso</div>
                        <div class="stat-value-user">{{ $proyectosEnCurso }}</div>
                        <small class="text-white">
                            <i class="fas fa-spinner mr-1"></i>En Progreso
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stat-card-user bg-danger text-white">
                    <div class="card-body">
                        <div class="stat-label-user">Pendientes</div>
                        <div class="stat-value-user">{{ $proyectosPendientes }}</div>
                        <small class="text-white">
                            <i class="fas fa-hourglass-start mr-1"></i>Sin Iniciar
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen de Actividades -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-3">Mis Actividades</h6>
                        <h2 class="text-primary font-weight-bold">{{ $totalActividades }}</h2>
                        <small class="text-muted">Tareas Asignadas</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-3">Completadas</h6>
                        <h2 class="text-success font-weight-bold">{{ $actividadesFinalizadas }}</h2>
                        <small class="text-muted">Finalizadas</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-3">En Curso</h6>
                        <h2 class="text-warning font-weight-bold">{{ $actividadesEnCurso }}</h2>
                        <small class="text-muted">En Ejecución</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-3">Pendientes</h6>
                        <h2 class="text-danger font-weight-bold">{{ $actividadesPendientes }}</h2>
                        <small class="text-muted">No Iniciadas</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promedios de Avance -->
        <div class="row mb-4">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-chart-pie mr-2"></i>Mi Avance en Proyectos
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $promedioAvanceProyectos }}%;"
                                aria-valuenow="{{ $promedioAvanceProyectos }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                                <strong>{{ round($promedioAvanceProyectos, 1) }}%</strong>
                            </div>
                        </div>
                        <p class="mt-3 text-muted text-sm mb-0">
                            <i class="fas fa-info-circle"></i>
                            Avance promedio de todos tus proyectos
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-tasks mr-2"></i>Mi Avance en Actividades
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar bg-info" role="progressbar"
                                style="width: {{ $promedioAvanceActividades }}%;"
                                aria-valuenow="{{ $promedioAvanceActividades }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                                <strong>{{ round($promedioAvanceActividades, 1) }}%</strong>
                            </div>
                        </div>
                        <p class="mt-3 text-muted text-sm mb-0">
                            <i class="fas fa-info-circle"></i>
                            Avance promedio de todas tus actividades
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Proyectos Destacados -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                            <i class="fas fa-star mr-2"></i>Mis Proyectos Destacados
                        </h3>
                        <a href="{{ route('proyectos.index') }}" class="btn btn-sm btn-info">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="font-weight-700">Proyecto</th>
                                    <th scope="col" class="font-weight-700">Área</th>
                                    <th scope="col" class="font-weight-700">Avance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($proyectosDestacados as $proyecto)
                                    <tr>
                                        <td>
                                            <a href="{{ route('proyectos.actividades', $proyecto->id) }}" class="text-primary font-weight-bold text-decoration-none">
                                                {{ Str::limit($proyecto->nombre, 25) }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $proyecto->areas->nombre ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <div class="progress" style="width: 80px; height: 6px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $proyecto->avance }}%;"></div>
                                            </div>
                                            <small class="text-muted">{{ $proyecto->avance }}%</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            <i class="fas fa-inbox"></i> No tienes proyectos aún
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Actividades Próximas a Vencer -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                            <i class="fas fa-calendar-alt mr-2"></i>Actividades Próximas
                        </h3>
                        <span class="badge badge-warning">{{ count($actividadesProximas) }}</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center mb-0 table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="font-weight-700">Actividad</th>
                                    <th scope="col" class="font-weight-700">Fecha</th>
                                    <th scope="col" class="font-weight-700">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($actividadesProximas as $actividad)
                                    <tr>
                                        <td class="text-truncate">
                                            <a href="{{ route('actividades.edit', $actividad->id) }}" class="text-primary font-weight-bold text-decoration-none">
                                                {{ Str::limit($actividad->nombre, 20) }}
                                            </a>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                @if($actividad->fecha_estimada)
                                                    {{ \Carbon\Carbon::parse($actividad->fecha_estimada)->format('d/m/Y') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </small>
                                        </td>
                                        <td>
                                            @switch($actividad->estado)
                                                @case(1)
                                                    <span class="badge badge-danger">Pendiente</span>
                                                @break
                                                @case(2)
                                                    <span class="badge badge-warning">En curso</span>
                                                @break
                                                @case(3)
                                                    <span class="badge badge-success">Finalizado</span>
                                                @break
                                                @default
                                                    <span class="badge badge-secondary">Desconocido</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            <i class="fas fa-check-circle"></i> No hay actividades próximas
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actividades que Requieren Atención -->
        <div class="row mt-4">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-exclamation-circle mr-2"></i>Actividades con Bajo Avance
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="font-weight-700">Actividad</th>
                                    <th scope="col" class="font-weight-700">Proyecto</th>
                                    <th scope="col" class="font-weight-700">Avance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($actividadesBajoAvance as $actividad)
                                    <tr class="border-left border-danger">
                                        <td>
                                            <strong class="text-dark">{{ Str::limit($actividad->nombre, 20) }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">{{ Str::limit($actividad->proyectos->nombre, 15) }}</span>
                                        </td>
                                        <td>
                                            <div class="progress" style="width: 100px; height: 6px;">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $actividad->avance }}%;"></div>
                                            </div>
                                            <small class="text-muted">{{ $actividad->avance }}%</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            <i class="fas fa-check-circle"></i> ¡Excelente! No tienes actividades con bajo avance
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Distribución por Área -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-folder-open mr-2"></i>Mis Proyectos por Área
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="font-weight-700">Área</th>
                                    <th scope="col" class="font-weight-700">Cantidad</th>
                                    <th scope="col" class="font-weight-700" style="width: 35%;">Progreso</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($proyectosPorArea as $area)
                                    <tr>
                                        <td>
                                            <span class="badge badge-info">{{ $area->nombre }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $area->total }}</strong>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ ($area->total / max($totalProyectos, 1)) * 100 }}%;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            Sin datos de áreas
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

    