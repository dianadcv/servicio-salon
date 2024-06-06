@extends('layouts.plantilla')

@section('title', 'Home')

<link rel="stylesheet" href="{{ asset('../resources/css/login.css') }}">

@section('content')

    <div class="form-container">

        <h1 class="titulo-principal">Crear Cuenta</h1>

        <form action={{ route('users.create') }} method="post" onsubmit="return validarContraseña()">
            @csrf
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div>
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required>
            </div>
            <div>
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div>
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required>
            </div>
            <div>
                <label for="confirmar_contraseña">Confirmar contraseña:</label>
                <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" required oninput="validarContraseña()">
                <span id="mensaje_error" style="color: red; display: none;">Las contraseñas no coinciden. Por favor, inténtalo de nuevo.</span>
            </div>

            <div>
                <button type="submit">Enviar</button>
                <a href="{{ route('home') }}">Regresar a Inicio</a>
            </div>
        </form>
    </div>

    <script>
        function validarContraseña() {
            var contraseña = document.getElementById("contraseña").value;
            var confirmarContraseña = document.getElementById("confirmar_contraseña").value;
            var mensajeError = document.getElementById("mensaje_error");

            if (contraseña != confirmarContraseña) {
                mensajeError.style.display = "inline"; 
                return false;
            } else {
                mensajeError.style.display = "none"; 
                return true;
            }
        }
    </script>

@endsection

