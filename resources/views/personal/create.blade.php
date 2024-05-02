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
                                <li class="breadcrumb-item"><a href="{{ route('personals.index') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="?view=diagnostico">Registro de Personal</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">Nuevo</li>
                            </ol>
                        </nav>

                    </div>
                    <div class="col-4">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0">
                                <a href="{{ route('personals.index') }}" class="btn btn-transparent py-2 px-3">
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
        <div class="row">
            <div class="col-xl-12 bg-white rounded mb-4 card ">
                <div class="mt-4 p-2 mr-2">
                    <form id="personalForm" action="{{ route('personals.store') }}" method="POST">
                        @csrf
                        <h6 class="heading-small text-muted mb-0">Información Basica del Personal Nuevo que Desea Registrar
                        </h6>
                        <p class="small mb-4"><i class="fas fa-info-circle"></i> Por favor, asegúrate de llenar todos los
                            campos requeridos marcados con <span class="text-danger">*</span> y verificar la información
                            antes de enviar el formulario.</p>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="tipo_documento">Tipo de Documento <span
                                                class="text-danger">*</span></label>
                                        <select name="tipo_documento" id="tipo_documento" class="form-control">
                                            <option value="" disabled>Seleccione una opción</option>
                                            <option value="CC" selected>Cédula de Ciudadanía</option>
                                            <option value="CE">Cédula de Extranjería</option>
                                            <option value="NIT">NIT</option>
                                            <option value="PAS">Pasaporte</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="numero_documento">Numero de Documento <span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="numero_documento" name="numero_documento"
                                            class="form-control" placeholder="Ingrese Su numero" required value="{{old('numero_documento')}}">
                                        @if ($errors->has('numero_documento'))
                                            <span class="text-danger">{{ $errors->first('numero_documento') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nombres">Nombres <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="nombres" name="nombres" class="form-control"
                                            placeholder="Ingrese Sus Nombres" required>
                                        @if ($errors->has('nombres'))
                                            <span class="text-danger">{{ $errors->first('nombres') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="apellidos">Apellidos</label>
                                        <input type="text" id="apellidos" name="apellidos" class="form-control"
                                            placeholder="Ingrese Sus Apellidos">
                                            @if ($errors->has('apellidos'))
                                            <span class="text-danger">{{ $errors->first('apellidos') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="correo">Correo electrónico <span
                                                class="text-danger">*</span></label>
                                        <input type="email" id="correo" name="correo" class="form-control"
                                            placeholder="Correo electrónico corporativo" required>
                                            @if ($errors->has('correo'))
                                            <span class="text-danger">{{ $errors->first('correo') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="telefono">Rol <span
                                                class="text-danger">*</span></label>
                                        <select name="rol" class="form-control" id="rol">
                                            <option value="">Seleccionar rol</option>
                                            @foreach ($roles as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ is_array($userRoles) && in_array($id, $userRoles) ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <button type="submit" id="btnCrearPersonal" class="btn btn-info mb-2">Crear
                                Personal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
