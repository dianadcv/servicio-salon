@extends('layouts.plantilla')

@section('title', 'Home')

<link rel="stylesheet" href="{{ asset('../resources/css/login.css') }}">

@section('content')

    <div class="form-container">

        <h1>Iniciar Sesión</h1>
        <form action="{{ route('users.check') }}" method="post">
            @csrf
            <div>
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" value="" required>
            </div>
            <div>
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" @if (Session::has('error')) value="" @endif
                    required>
            </div>

            
            <div>
                <button type="submit">Acceder</button>
                <a href="{{ route('users.registrar') }}">Registrarse</a>
            </div>
        </form>

        <!-- Modal de Error -->
        @if (Session::has('error'))
            <div id="errorModalWrapper">
                <div class="modal fade show" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
                    aria-hidden="true" style="display: block;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                {{ Session::get('error') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
