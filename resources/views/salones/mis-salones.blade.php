@extends('layouts.plantilla')

@section('title', 'Home')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('../resources/css/home.css') }}">

@section('content')

    <h1 class="titulo-principal"><strong>Bienvenido </strong>{{ $user->name }} </h1>
    <hr class="linea">

    <div class="button-container">
        <a href="{{ route('salones.create', $user->id) }}" class="btn">Subir salón</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Cerrar Sesión</a>
        <a href="{{ route('renta.show', $user->id) }}" class="btn btn-secondary">Mostrar Rentas</a>
        <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary">Administrar Sesión</a>
        <a href="{{ route('salones.index', $user->id) }}" class="btn btn-secondary">Ir a salones</a>
    </div>

    <div class="salones-container">
        @foreach ($salones as $salon)
            <div class="salon">
                @php
                    $imagenSalon = $salones_imagenes->where('salon_id', $salon->id)->first();
                @endphp
                <div class="salon-content">
                    @if ($imagenSalon)
                        <div class="salon-imagen">
                            <img src="{{ asset($imagenSalon->image) }}" alt="Imagen del salón {{ $salon->name }}"
                                width="100%">
                        </div>
                    @endif
                    <div class="salon-details">
                        <h2><a
                                href="{{ route('salones.show', ['users' => $user->id, 'salon' => $salon->id]) }}">{{ $salon->name }}</a>
                        </h2>
                        <p>{{ $salon->address }}</p>
                        <p>{{ $salon->description }}</p>
                        <a href="{{ route('salones.edit', ['users' => $user->id, 'salon' => $salon->id]) }}"
                            class="btn btn-secondary">Editar</a>

                        <a href="#" class="btn btn-primary" data-toggle="modal"
                            data-target="#deleteModal{{ $user->id }}-{{ $salon->id }}">Eliminar</a>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $user->id }}-{{ $salon->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="deleteModalLabel{{ $user->id }}-{{ $salon->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="deleteModalLabel{{ $user->id }}-{{ $salon->id }}">Confirmar
                                            eliminación</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que quieres eliminar este salón?
                                        <p>Esta acción no se puede deshacer.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('salones.delete', ['users' => $user->id, 'id' => $salon->id]) }}"
                                            class="btn btn-primary">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
