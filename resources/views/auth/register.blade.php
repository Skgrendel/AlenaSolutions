@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="header bg-gradient-info pt-7 pb-5 pb-lg-6 pt-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <img src="../assets/img/images/LogoAlenaSolution.svg" alt=""
                            style="width: 250px; higth: 150px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-7 pb-lg-0">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7">
                <div class="card animated bg-white mb-0">
                    <div class="card-body px-lg-5 py-lg-5">
                            <form id="personalForm" action="{{ route('Registrarse.store') }}" method="POST">
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
                                        <div class="col-12">
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
                                        <hr class="my-4">
                                    <button type="submit" id="btnCrearPersonal" class="btn btn-info mb-2">Crear
                                        Usuario</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        @if (session('success'))
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('success') }}",
                icon: "{{ session('icon') }}"
            });
        @endif
    </script>
@endsection
