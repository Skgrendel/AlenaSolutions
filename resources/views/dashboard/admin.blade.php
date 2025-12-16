@extends('layouts.page.dashboard')

@section('content')
    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .dashboard-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }

        .stat-card {
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: none;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-card.bg-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card.bg-success {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stat-card.bg-warning {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-card.bg-danger {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin: 1rem 0;
        }

        .stat-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
        }

        .stat-footer {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
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

        .table-responsive {
            border-radius: 0 0 10px 10px;
        }

        .badge {
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
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
    </style>

    <div class="dashboard-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="dashboard-title">
                    <i class="fas fa-chart-line mr-2"></i>Dashboard Administrativo
                </h1>
                <p class="text-white mb-0">
                    <i class="fas fa-info-circle mr-2"></i>Resumen completo del estado de proyectos y actividades
                </p>
            </div>
            <div class="col-md-4 text-right">
                <button class="btn btn-light btn-sm">
                    <i class="fas fa-download mr-2"></i>Exportar Datos
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Tarjetas de Resumen de Proyectos -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stat-card bg-info text-white">
                    <div class="card-body">
                        <div class="stat-label">Proyectos Totales</div>
                        <div class="stat-value">{{ $totalProyectos }}</div>
                        <div class="stat-footer">
                            <i class="fas fa-check-circle mr-1"></i>Activos en el sistema
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stat-card bg-success text-white">
                    <div class="card-body">
                        <div class="stat-label">Finalizados</div>
                        <div class="stat-value">{{ $proyectosFinalizados }}</div>
                        <div class="stat-footer">
                            <i class="fas fa-check-double mr-1"></i>{{ round(($proyectosFinalizados / max($totalProyectos, 1)) * 100, 1) }}% Completados
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stat-card bg-warning text-white">
                    <div class="card-body">
                        <div class="stat-label">En Curso</div>
                        <div class="stat-value">{{ $proyectosEnCurso }}</div>
                        <div class="stat-footer">
                            <i class="fas fa-spinner mr-1"></i>En progreso
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stat-card bg-danger text-white">
                    <div class="card-body">
                        <div class="stat-label">Pendientes</div>
                        <div class="stat-value">{{ $proyectosPendientes }}</div>
                        <div class="stat-footer">
                            <i class="fas fa-hourglass-start mr-1"></i>Sin iniciar
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjetas de Resumen de Actividades -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-3">Actividades Totales</h6>
                        <h2 class="text-primary font-weight-bold">{{ $totalActividades }}</h2>
                        <small class="text-muted">Tareas registradas</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-3">Finalizadas</h6>
                        <h2 class="text-success font-weight-bold">{{ $actividadesFinalizadas }}</h2>
                        <small class="text-muted">Completadas</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-3">En Curso</h6>
                        <h2 class="text-warning font-weight-bold">{{ $actividadesEnCurso }}</h2>
                        <small class="text-muted">En ejecución</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-3">Pendientes</h6>
                        <h2 class="text-danger font-weight-bold">{{ $actividadesPendientes }}</h2>
                        <small class="text-muted">No iniciadas</small>
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
                            <i class="fas fa-tachometer-alt mr-2"></i>Avance Promedio de Proyectos
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar bg-gradient-primary" role="progressbar"
                                style="width: {{ $promedioAvanceProyectos }}%;"
                                aria-valuenow="{{ $promedioAvanceProyectos }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                                <strong>{{ round($promedioAvanceProyectos, 1) }}%</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-tasks mr-2"></i>Avance Promedio de Actividades
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar bg-gradient-success" role="progressbar"
                                style="width: {{ $promedioAvanceActividades }}%;"
                                aria-valuenow="{{ $promedioAvanceActividades }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                                <strong>{{ round($promedioAvanceActividades, 1) }}%</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Proyectos por Usuario -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-users mr-2"></i>Proyectos por Usuario
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="font-weight-700">Usuario</th>
                                    <th scope="col" class="font-weight-700">Total</th>
                                    <th scope="col" class="font-weight-700">Finalizados</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($proyectosPorUsuario as $usuario)
                                    <tr>
                                        <td>
                                            <span class="badge badge-info">{{ $usuario->nombre }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light">{{ $usuario->total }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">{{ $usuario->finalizados ?? 0 }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">Sin proyectos</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Proyectos por Área -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-sitemap mr-2"></i>Distribución por Área
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
                                        <td>{{ $area->nombre }}</td>
                                        <td>
                                            <span class="badge badge-warning">{{ $area->total }}</span>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: {{ ($area->total / max($totalProyectos, 1)) * 100 }}%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">Sin datos</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Proyectos Destacados -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-star mr-2"></i>Proyectos Destacados
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="font-weight-700">Nombre</th>
                                    <th scope="col" class="font-weight-700">Propietario</th>
                                    <th scope="col" class="font-weight-700">Avance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($proyectosDestacados as $proyecto)
                                    <tr>
                                        <td>
                                            <strong class="text-dark">{{ Str::limit($proyecto->nombre, 20) }}</strong>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                @if($proyecto->user && $proyecto->user->personal)
                                                    {{ $proyecto->user->personal->nombres ?? 'N/A' }} {{ $proyecto->user->personal->apellidos ?? '' }}
                                                @else
                                                    <span class="badge badge-secondary">N/A</span>
                                                @endif
                                            </small>
                                        </td>
                                        <td>
                                            <div class="progress" style="width: 100px; height: 6px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $proyecto->avance }}%;">
                                                </div>
                                            </div>
                                            <small class="text-muted">{{ $proyecto->avance }}%</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">Sin proyectos</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Actividades con Bajo Avance -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Actividades que Requieren Atención
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
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $actividad->avance }}%;">
                                                </div>
                                            </div>
                                            <small class="text-muted">{{ $actividad->avance }}%</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            <i class="fas fa-check-circle"></i> Sin actividades críticas
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Distribución de Prioridades -->
        <div class="row mt-4">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-layer-group mr-2"></i>Distribución de Prioridades en Proyectos
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="font-weight-700">Prioridad</th>
                                    <th scope="col" class="font-weight-700">Cantidad</th>
                                    <th scope="col" class="font-weight-700" style="width: 40%;">Distribución</th>
                                    <th scope="col" class="font-weight-700">Porcentaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($prioridadesPoryecto as $prioridad)
                                    <tr>
                                        <td>
                                            <span class="badge badge-{{ match($prioridad->nombre) {
                                                'Baja' => 'info',
                                                'Media' => 'warning',
                                                'Alta' => 'danger',
                                                default => 'secondary'
                                            } }}">{{ $prioridad->nombre }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $prioridad->total }}</strong>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-{{ match($prioridad->nombre) {
                                                    'Baja' => 'info',
                                                    'Media' => 'warning',
                                                    'Alta' => 'danger',
                                                    default => 'secondary'
                                                } }}" role="progressbar"
                                                    style="width: {{ ($prioridad->total / max($totalProyectos, 1)) * 100 }}%;">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ round(($prioridad->total / max($totalProyectos, 1)) * 100, 1) }}%</strong>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Sin datos de prioridades</td>
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

