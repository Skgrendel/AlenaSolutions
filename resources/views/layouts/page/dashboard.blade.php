<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplicación AuditApp">
    <!-- Favicon -->
    <link rel="icon" href="{{asset('/assets/img/brand/favicon.png')}}" type="image/png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <script src="https://kit.fontawesome.com/049e213d27.js" crossorigin="anonymous"></script>
    <!-- Bootstrap File Input -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.1.2/css/fileinput.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.1.2/themes/explorer-fas/theme.min.css">
    <!-- SweetAlert 2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.5/dist/sweetalert2.min.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

    <!-- Bootstrap-select: No le puse CDN por que modifiqué los archivos -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-select/css/bootstrap-select.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/stepper/bsStepper.min.css')}}">

    <!-- SmartWizard - V. 4.3.1 ya que la version mas actual 5.1 genera error, habria que actualizar codigo -->
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/glightbox/glightbox.min.css')}}">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/argon.min.css?v=1.1.0')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/mystyle.css')}}">
    {{-- Personalize CSS --}}
    @yield('css')

</head>

<body class="body-page">

    @include('layouts.page.sidebar')
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        @include('layouts.page.nav')

        <div class="container-fluid mt-5">
            @yield('content')
            @include('layouts.page.footer')
        </div>
    </div>
    <div class="modal fade" id="soporteModal" tabindex="-1" aria-labelledby="soporteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="soporteModalLabel">Soporte técnico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="soporte-form" action="{{ route('enviar-correo-soporte') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo electrónico:</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje:</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- Cookie Js -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <!-- Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2"></script>
    <!-- Jquery ScrollLock -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-scroll-lock@3.1.3/jquery-scrollLock.min.js"></script>
    <!-- Bootstrap FileInput -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.1.2/js/fileinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.1.2/themes/explorer-fas/theme.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.1.2/themes/fas/theme.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.1.2/js/locales/es.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.5/dist/sweetalert2.min.js"></script>
    <!-- Jquery Validation -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
    <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap4.min.js"></script>
    <!-- Bootstrap-select -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-es_ES.min.js"></script>
    <!-- SmartWizard -->
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
    <!-- Jquery-UI - Script solo tiene la función Draggable -->
    <script src="{{asset('assets/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- PDF Object -->
    <script src="https://cdn.jsdelivr.net/npm/pdfobject@2.2.3/pdfobject.min.js"></script>
    <!-- HTML CANVAS -->
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.7/dist/html2canvas.min.js"></script>
    <!-- Argon JS -->
    <script src="{{asset('/assets/js/argon.min.js?v=1.1.0')}}"></script>
    {{-- Personalize js --}}
    <script src="{{ asset('assets/vendor/glightbox/glightbox.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/glightbox/custom-glightbox.min.js')}}"></script>
    <script src="{{asset('assets/libs/stepper/bsStepper.min.js')}}"></script>
    @yield('js')
</body>

</html>
