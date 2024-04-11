@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="header bg-gradient-success pt-7 pb-5 pb-lg-6 pt-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white">Bienvenido!</h1>
                        <p class="text-lead text-white">Un conjunto de herramientas {{ config('app.name', 'Laravel') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-7 pb-lg-0">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card animated bg-white mb-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <p>Inicie sesión con sus credenciales</p>
                        </div>
                        <div id="div-form-login">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="Usuario">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password" placeholder="Contraseña">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" id="btn-iniciar-sesion" class="btn btn-success">Iniciar
                                        sesión</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
