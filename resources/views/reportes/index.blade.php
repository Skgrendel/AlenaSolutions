@extends('layouts.page.dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <!-- Encabezado -->
            <div class="header bg-gradient-info rounded  pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-8">
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                                    class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="?view=diagnostico">Reportes</a></li>
                                        <li class="breadcrumb-item text-dark active" aria-current="page">AlenaSolutions</li>
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
                    <div class="col-xl-12 bg-white rounded mb-4 card ">
                        <div class="mt-4 p-2 mr-2">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center ">
                                    @can('administrador')
                                        <div class="card border mr-1 ">
                                            <div class="card-body text-center">
                                                <div class=" d-flex justify-content-center ">
                                                    <img alt="" src="{{ asset('/assets/img/images/logo_vixor.svg') }}"
                                                        class="avatar avatar-xl rounded m-2 bg-transparent ">
                                                    <a type="button" href="{{ route('Rerpotevixor') }}" class="btn">
                                                        <div class="d-block text-center">
                                                            <br> <span class="text-sm">Reportes</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                    <div class="card border mr-1 ">
                                        <div class="card-body text-center">
                                            <div class=" d-flex justify-content-center ">
                                                <img alt="" src="{{ asset('/assets/img/images/proderi.svg') }}"
                                                    class="avatar avatar-xl rounded m-2 bg-transparent ">
                                                <a type="button" href="{{ route('proderiIndex') }}" class="btn">
                                                    <div class="d-block text-center">
                                                        <br> <span class="text-sm">Reportes</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @can('administrador')
                                        <div class="card border mr-1 ">
                                            <div class="card-body text-center">
                                                <div class=" d-flex justify-content-center ">
                                                    <img alt="" src="{{ asset('/assets/img/images/LogoAlena.svg') }}"
                                                        class="avatar avatar-xl rounded m-2 bg-transparent ">
                                                    <a type="button" href="{{ route('ReportOperaciones') }}" class="btn">
                                                        <div class="d-block text-center">
                                                            <br> <span class="text-sm">Reportes</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border mr-1 ">
                                            <div class="card-body text-center">
                                                <div class=" d-flex justify-content-center ">
                                                    <img alt=""
                                                        src="{{ asset('/assets/img/images/LogoAlenaQanalyticData.svg') }}"
                                                        class="avatar avatar-xl rounded m-2 bg-transparent">
                                                    <a type="button" href="{{ route('ReportQanalytic') }}" class="btn">
                                                        <div class="d-block text-center">
                                                            <br> <span class="text-sm">Reportes</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border mr-1 ">
                                            <div class="card-body text-center">
                                                <div class=" d-flex justify-content-center ">
                                                    <img alt=""
                                                        src="{{ asset('/assets/img/images/logo_caplaft.svg') }}"
                                                        class="avatar avatar-xl rounded m-2 bg-transparent">
                                                    <a type="button" href="#!" class="btn">
                                                        <div class="d-block text-center">
                                                            <br> <span class="text-sm">Reportes</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border mr-1 ">
                                            <div class="card-body text-center">
                                                <div class=" d-flex justify-content-center ">
                                                    <img alt=""
                                                        src="{{ asset('/assets/img/images/Logo_Acoficum.svg') }}"
                                                        class="avatar avatar-xl rounded m-2 bg-transparent">
                                                    <a type="button" href="{{route('acoficum')}}" class="btn">
                                                        <div class="d-block text-center">
                                                            <br> <span class="text-sm">Reportes</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
@endsection
