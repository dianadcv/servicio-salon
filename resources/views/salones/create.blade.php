@extends('layouts.plantilla')

@section('title', 'Home')

<link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">

@section('content')

    <h1>En esta página podras registrar tu salón</h1>
    <center>
        <h2 class="titulo-principal"><strong>Propietario: </strong>{{ $user->name }} {{ $user->last_name }}</h2>
    </center>

    <form action={{ route('salones.store', $user->id) }} method="POST" enctype="multipart/form-data">

        @csrf

        <div>
            <label for="name">Nombre del Salón:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div>
            <label for="capacity">Capacidad:</label>
            <input type="number" id="capacity" name="capacity" min="0" required>
        </div>
        <div>
            <label for="price">Precio:</label>
            <input type="number" step="0.01" id="price" name="price" min="0" required>
        </div>
        <div>
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" rows="4" cols="79" required style="resize: none;"></textarea>
        </div>
        <div>
            <label for="featured">Imágenes:</label>
            <input type="file" id="featured" name="featured[]" multiple required>
        </div>
        <div>
            <label for="available">Disponible:</label>
            <input type="hidden" name="available" value="0">
            <input type="checkbox" id="available" name="available" value="1" {{ old('available') ? 'checked' : '' }}>
        </div>
        <input type="hidden" id="owner" name="owner" value="{{ $user->id }}">

        <div class="button-container">
            <!--<a href="{{ route('salones.goBack') }}" class="btn">Regresar</a>-->
            <button class="btn" type="submit">Crear Salón</button>
            <a href="{{ route('salones.index', $user) }}" class="btn">Ir a inicio</a>
        </div>
    </form>


@endsection()

