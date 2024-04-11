@extends('layouts.page.dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-12">
           <!-- Encabezado -->
    <div class="header bg-gradient-success rounded  pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-8">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="?view=diagnostico">Reportes</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">AlenaSolutions</li>
                            </ol>
                        </nav>

                    </div>
                    <div class="col-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class="card-body">
                <div class="row d-flex justify-content-center ">
                    <div class="card border mr-1 ">
                        <div class="card-body text-center">
                            <div class=" d-flex justify-content-center ">
                                <img alt="" src="../assets/img/images/logo_vixor.svg"
                                    class="avatar avatar-lg rounded-circle m-2 bg-primary ">
                                <a type="button" href="{{route('Rerpotevixor')}}" class="btn">
                                    <div class="d-block text-center">
                                        <span class="text-sm">Vixor</span>
                                        <br> <span class="text-xs">Reportes</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card border mr-1 ">
                        <div class="card-body text-center">
                            <div class=" d-flex justify-content-center ">
                                <img alt="" src="../assets/img/images/proderi.svg"
                                    class="avatar avatar-lg rounded-circle m-2 bg-primary ">
                                <a type="button" href="{{route('ReportOperaciones')}}" class="btn">
                                    <div class="d-block text-center">
                                        <span class="text-sm">Proderi</span>
                                        <br><span class="text-sm">Operaciones</span>
                                        <br> <span class="text-xs">Reportes</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script></script>
@endsection
