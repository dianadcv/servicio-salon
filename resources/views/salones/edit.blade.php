@extends('layouts.plantilla')

@section('title', 'Home')

<link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">

@section('content')

    <h1>En esta página podras editar tu salón {{ $salon->name }}</h1>

    <form action="{{ route('salones.update', ['users' => $users, 'salon' => $salon]) }}" method="POST">

        @csrf
        @method('put')

        <div>
            <label for="name">Nombre del Salón:</label>
            <input type="text" id="name" name="name" required value="{{ $salon->name }}">
        </div>
        <div>
            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address" required value="{{ $salon->address }}">
        </div>
        <div>
            <label for="capacity">Capacidad:</label>
            <input type="number" id="capacity" name="capacity" required value="{{ $salon->capacity }}">
        </div>
        <div>
            <label for="price">Precio:</label>
            <input type="number" step="0.01" id="price" name="price" required value="{{ $salon->price }}">
        </div>
        <div>
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" required>{{ $salon->description }}</textarea>
        </div>
        <div>
            <input type="hidden" name="available" value="0">
            <input type="checkbox" id="available" name="available" {{ $salon->available ? 'checked' : '' }}>
            <label for="available">Disponible</label>
        </div>
        <div>
            <button type="submit">Actualizar Salón</button>
        </div>
    </form>

    <div class="button-container">
        <a href="{{ route('salones.index', $users) }}" class="btn">Ir a salones</a>
    </div>


@endsection()
