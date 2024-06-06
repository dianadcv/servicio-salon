@extends('layouts.plantilla')

@section('title', 'Home')

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Usuario</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="{{ asset('../resources/css/user-edit.css') }}">


@section('content')
    <h1 class="titulo-principal">Edita tu información</h1>

    <form action={{ route('users.update', $user->id) }} method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $user->name }}" required>
        </div>
        <div>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="{{ $user->last_name }}" required>
        </div>
        <div>
            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" value="{{ $user->email }}" required>
        </div>
        <div>
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>
        </div>
        <div class="center-container">
            <button class="btn" type="submit">Actualizar</button>
            <a href="#" class="btn" data-toggle="modal" data-target="#deleteModal">Eliminar</a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que quieres eliminar este usuario?
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a href="{{ route('users.delete', $user->id) }}" class="btn btn-primary">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
