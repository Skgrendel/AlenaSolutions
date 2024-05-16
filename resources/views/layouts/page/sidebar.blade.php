<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <img src="{{ asset('/assets/img/images/LogoAlenaSolution.svg') }}" alt=""
                style="width: 150px; higth: 150px;" class="mt-2">
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <h6 class="navbar-heading p-0 text-muted">Herramientas</h6>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('proyectos.index') }}">
                            <i class="fas fa-project-diagram text-info"></i>
                            <span class="nav-link-text">Procesos de Area</span>
                        </a>
                    </li>
                    @php
                        $user = Auth::user();
                    @endphp
                    @if ($user->personal->areas->nombre == 'Consultores'|| $user->hasRole('Administrador'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auditorias.index') }}">
                                <i class="fas fa-swatchbook text-info"></i>
                                <span class="nav-link-text">Auditorias</span>
                            </a>
                        </li>
                    @endif
                </ul>

                <hr class="my-3">
                <h6 class="navbar-heading p-0 text-muted">Reportes</h6>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Rerpoteindex') }}">
                            <i class="ni ni-single-copy-04 text-info"></i>
                            <span class="nav-link-text">Informes</span>
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                @if ($user->hasRole('Administrador'))
                    <hr class="my-3">
                    <h6 class="navbar-heading p-0 text-muted">Configuracion</h6>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('personals.index') }}">
                                <i class="fas fa-users text-info"></i>
                                <span class="nav-link-text">Usuarios</span>
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
</nav>
