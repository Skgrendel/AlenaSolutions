@extends('layouts.page.dashboard')

@section('content')
    <!-- Encabezado -->
    <div class="header bg-gradient-info rounded  pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-8">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('auditorias.index') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Nuevo Grupo de Diagnostico</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">Nuevo</li>
                            </ol>
                        </nav>

                    </div>
                    <div class="col-4">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0">
                                <a href="{{ route('auditorias.index') }}" class="btn btn-transparent py-2 px-3">
                                    <span class="d-none d-md-block">Volver</span>
                                    <span class="d-md-none"><i class="fas fa-arrow-left"></i></span>
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Contenido -->
    <div id="contenedorFullPreguntas" class="container-fluid mt--6">
        <form id="auditoriasform" action="{{ route('auditorias.store') }}" method="POST">
            @csrf
        <div class="row">
            <div class="col-xl-12 bg-white rounded mb-4 card ">
                <h6 class="heading-small text-muted mb-0 my-4">Información del Grupo</h6>
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="nombre_grupo">Nombre del Grupo <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="nombre_grupo" name="nombre_grupo" class="form-control"
                                    placeholder="Ejemplo: Prueba Piloto para Alena" required value="{{ old('nombre_grupo') }}" >
                                @if ($errors->has('nombre_grupo'))
                                    <span class="text-danger">{{ $errors->first('nombre_grupo') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="descripcion_grupo">Descripcion<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="descripcion_grupo" name="descripcion_grupo" class="form-control"
                                    placeholder="Pruebas de Diagnosticos que se realizaron en la empresa Alena " required value="{{ old('descripcion_grupo') }}" >
                                @if ($errors->has('descripcion_grupo'))
                                    <span class="text-danger">{{ $errors->first('descripcion_grupo') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class=" p-2 mr-2">
                        <h6 class="heading-small text-muted mb-0">Información de la  empresa que Asosiada al Grupo
                        </h6>
                        <p class="small mb-4"><i class="fas fa-info-circle"></i> Por favor, asegúrate de llenar todos los
                            campos requeridos marcados con <span class="text-danger">*</span> y verificar la información
                            antes de enviar el formulario. <br> Los diagnósticos que se crean dentro de los grupos, son realizados para una empresa en especifico.</p>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nombre_empresa">Nombre de la Empresa <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="nombre_empresa" name="nombre_empresa" class="form-control"
                                            placeholder="Ingrese El Nombre de la Empresa" required value="{{ old('nombre_empresa') }}" >
                                        @if ($errors->has('nombre_empresa'))
                                            <span class="text-danger">{{ $errors->first('nombre_empresa') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nit_empresa">NIT <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="nit_empresa" name="nit_empresa" class="form-control"
                                            placeholder="Ingrese El NIT de la empresa" required value="{{ old('nit_empresa') }}" >
                                        @if ($errors->has('nit_empresa'))
                                            <span class="text-danger">{{ $errors->first('nit_empresa') }}</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="correo_empresa">Correo Electronico <span
                                                class="text-danger">*</span></label>
                                        <input type="email" id="correo_empresa" name="correo_empresa" class="form-control"
                                            placeholder="Correo Electronito Coorporativo" required value="{{ old('correo_empresa') }}" >
                                        @if ($errors->has('correo_empresa'))
                                            <span class="text-danger">{{ $errors->first('correo_empresa') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="direccion_empresa">Direccion</label>
                                        <input type="text" id="direccion_empresa" name="direccion_empresa" class="form-control"
                                            placeholder="Ingrese la Direccion"  value="{{ old('direccion_empresa') }}" >
                                        @if ($errors->has('direccion_empresa'))
                                            <span class="text-danger">{{ $errors->first('direccion_empresa') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="direccion_empresa2">Direccion #2</label>
                                        <input type="text" id="direccion_empresa2" name="direccion_empresa2" class="form-control"
                                            placeholder="Ingrese la Direccion"  value="{{ old('direccion_empresa2') }}" >
                                        @if ($errors->has('direccion_empresa2'))
                                            <span class="text-danger">{{ $errors->first('direccion_empresa2') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="telefono_fijo">Telefono Fijo </label>
                                        <input type="number" id="telefono_fijo" name="telefono_fijo" class="form-control"
                                            placeholder="Ingrese El Telefono" value="{{ old('telefono_fijo') }}" >
                                        @if ($errors->has('telefono_fijo'))
                                            <span class="text-danger">{{ $errors->first('telefono_fijo') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="telefono_celular">Celular Corporativo</label>
                                        <input type="number" id="telefono_celular" name="telefono_celular" class="form-control"
                                            placeholder="Ingrese El Celular Corporativo"  value="{{ old('telefono_celular') }}" >
                                        @if ($errors->has('telefono_celular'))
                                            <span class="text-danger">{{ $errors->first('telefono_celular') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nombre_oficial_cumplimiento">Oficial de Cumplimiento <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="nombre_oficial_cumplimiento" name="nombre_oficial_cumplimiento" class="form-control"
                                            placeholder="Ingrese El Nombre del Oficial de Cumplimiento"  value="{{ old('nombre_oficial_cumplimiento') }}" >
                                        @if ($errors->has('nombre_oficial_cumplimiento'))
                                            <span class="text-danger">{{ $errors->first('nombre_oficial_cumplimiento') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="btnCrearActividad" class="btn btn-info mb-2">Crear nuevo Grupo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
