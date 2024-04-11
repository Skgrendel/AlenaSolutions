@extends('layouts.page.dashboard')

@section('content')
    <!-- Encabezado -->
    <div class="header bg-success rounded  pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-8">
                        <h6 class="h2 text-white d-inline-block mb-0">Nuevos diagnósticos</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="?view=diagnostico">Diagnóstico</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Nueva Empresa</li>
                            </ol>
                        </nav>

                    </div>
                    <div class="col-4">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0">
                                <a href="{{ route('home') }}" class="btn btn-transparent py-2 px-3">
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
            <div class="col-xl-12">
                <div class="card bg-white">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h5 id="labelNombreDiagnostico" class="h3 mb-0">Crear Empresa para Auditar</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form id="formnuevaempresa" action="{{route('empresas.store')}}"  method="POST">
                            @csrf
                            <h6 class="heading-small text-muted mb-0">Información de la empresa</h6>
                            <p class="small mb-4"><i class="fas fa-info-circle"></i> Los diagnósticos que se crean son
                                realizados para una empresa en especifico.</p>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="nombreEmpresa">Nombre de la empresa <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="nombreEmpresa" name="nombre"
                                                class="form-control" placeholder="Nombre de la empresa" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="nit">NIT <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="nit" name="nit" class="form-control"
                                                placeholder="NIT" required>
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
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="direccion">Dirección<span
                                                class="text-danger">*</span></label>
                                            <input type="text" id="direccion" name="direccionp" class="form-control"
                                                placeholder="Dirección" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="direccion2">Dirección #2</label>
                                            <input type="text" id="direccion2" name="direccions" class="form-control"
                                                placeholder="Dirección #2">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="telefono">Teléfono fijo</label>
                                            <input type="number" id="telefono" name="telefono" class="form-control"
                                                placeholder="Teléfono">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="celular">Celular corporativo<span
                                                class="text-danger">*</span></label>
                                            <input type="number" id="celular" name="movil" class="form-control"
                                                placeholder="Celular corporativo" required>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">
                                <button type="submit" class="btn btn-success">Crear nuevo</button>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endsection
