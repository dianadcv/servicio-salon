@extends('layouts.plantilla')

@section('title', 'Home')

<link rel="stylesheet" href="{{ asset('../resources/css/show.css') }}">

@section('content')

    <h1 class="titulo-principal">{{ $salon->name }} </h1>
    <hr class="linea">
    <div class="button-container">
        <a href="{{ route('salones.index', ['users' => $users, 'salon' => $salon]) }}" class="btn">Ir a salones</a>
    </div>

    <div class="seccion-25">
        <p><strong>Nombre:</strong> {{ $salon->name }}</p>
        <p><strong>Dirección:</strong> {{ $salon->address }}</p>
        <p><strong>Capacidad:</strong> {{ $salon->capacity }}</p>
        <p><strong>Precio:</strong> {{ $salon->price }}</p>
        <p><strong>Descripción:</strong> {{ $salon->description }}</p>
        <p><strong>Disponible:</strong> {{ $salon->available ? 'Sí' : 'No' }}</p>
        @if ($salon->owner != $users->id)
            @include('renta.formulario', ['user' => $users, 'salon' => $salon, 'rentas' => $rentas])
        @endif
    </div>

    <div class="seccion-75">
        @foreach ($salones_imagenes as $imagenSalon)
            <div class="salon-imagen">
                <img src="{{ asset($imagenSalon->image) }}" alt="Imagen del salón {{ $salon->name }}">
            </div>
        @endforeach
    </div>

@endsection()
