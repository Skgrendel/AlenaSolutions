@extends('layouts.page.dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <p class="card-text"> Reportes Alena</p>
            <div class="card-body">
                <div class="row d-flex justify-content-center ">
                    {{-- Boton de reporte --}}
                    <div class="card border mr-1 ">
                        <div class="card-body text-center">
                            <div class=" d-flex justify-content-center ">
                                <img alt="" src="../assets/img/images/defaultPerfil.png"
                                    class="avatar avatar-lg rounded-circle m-2 ">
                                <button type="button" class="btn btn-floating">
                                    Primary
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card border mr-1 ">
                        <div class="card-body text-center">
                            <div class=" d-flex justify-content-center ">
                                <img alt="" src="../assets/img/images/defaultPerfil.png"
                                    class="avatar avatar-lg rounded-circle m-2 ">
                                <button type="button" class="btn btn-floating">
                                    Primary
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card border mr-1 ">
                        <div class="card-body text-center">
                            <div class=" d-flex justify-content-center ">
                                <img alt="" src="../assets/img/images/defaultPerfil.png"
                                    class="avatar avatar-lg rounded-circle m-2 ">
                                <button type="button" class="btn btn-floating">
                                    Primary
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card border mr-1 ">
                        <div class="card-body text-center">
                            <div class=" d-flex justify-content-center ">
                                <img alt="" src="../assets/img/images/defaultPerfil.png"
                                    class="avatar avatar-lg rounded-circle m-2 ">
                                <button type="button" class="btn btn-floating">
                                    Primary
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card border mr-1 ">
                        <div class="card-body text-center">
                            <div class=" d-flex justify-content-center ">
                                <img alt="" src="../assets/img/images/defaultPerfil.png"
                                    class="avatar avatar-lg rounded-circle m-2 ">
                                <button type="button" class="btn btn-floating">
                                    Primary
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card border mr-1 ">
                        <div class="card-body text-center">
                            <div class=" d-flex justify-content-center ">
                                <img alt="" src="../assets/img/images/defaultPerfil.png"
                                    class="avatar avatar-lg rounded-circle m-2 ">
                                <button type="button" class="btn btn-floating">
                                    Primary
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card border mr-1 ">
                        <div class="card-body text-center">
                            <div class=" d-flex justify-content-center ">
                                <img alt="" src="../assets/img/images/defaultPerfil.png"
                                    class="avatar avatar-lg rounded-circle m-2 ">
                                <button type="button" class="btn btn-floating">
                                    Primary
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal nuevo diagnostico -->
    <div class="modal fade" id="modalNuevoDiagnostico" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-gradient-secondary">
                <div class="modal-header">
                    <h4 class="mb-0" id="exampleModalCenterTitle">Crear nueva Auditoria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class=" text-center">
                        <i class="fas fa-chart-bar fa-3x"></i>
                        <h4 class="mt-4">¿Que tipo de Auditoria va a elegir?</h4>
                        <div class="mt-3">
                            <div class="col-12 mx-auto" style="width: 300px;">
                                <form id="formTipoDiagnostico" method="POST">
                                    <div class="form-group">
                                        <select class="selectpicker bg-white show-tick form-control" data-container="body"
                                            data-header="Seleccione el tipo de prueba" id="tipoDiagnostico"
                                            name="tipoDiagnostico" title="Seleccione el tipo de diagnostico"
                                            data-style="btn-neutral font-weight-400" required>
                                            <optgroup data-divider="false" label="Recientes">
                                                <option value="1"
                                                    data-content="<span> Auditoria de SAGRILAFT.</span> <small class='text-muted'>">
                                                </option>
                                            </optgroup>
                                        </select>
                                        <small class="" style="font-size: 11px !important;">Tipo de diagnostico con
                                            el
                                            cual se va a evaluar.</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-muted mr-auto" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline-success" id="btnComenzarDiagnostico">Comenzar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ver diagnosticos del grupo -->
    <div class="modal fade" id="modalVerDiagnosticosGrupo" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="card mb-0">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <h4 class="mb-0 modalNombreGrupo"></h4>
                                <p class="text-sm mb-0">Diagnosticos que pertenecen a este grupo.</p>
                            </div>
                            <div class="col-2">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive py-2">
                            <table id="tableDiagnosticosPorGrupo"
                                class="table align-items-center table-bordered table-hover w-100">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nombre del diagnostico</th>
                                        <th scope="col">Tipo de prueba</th>
                                        <th scope="col">Fecha de creación</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
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
