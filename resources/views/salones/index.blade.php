@extends('layouts.plantilla')

@section('title', 'Home')

<link rel="stylesheet" href="{{ asset('../resources/css/home.css') }}">

@section('content')

    <div class="button-container">
        <a href="{{ route('home') }}" class="btn btn-secondary">Cerrar Sesión</a>
        <a href="{{ route('salones.mine', $user->id) }}" class="btn btn-secondary">Administrar salones</a>
    </div>

    <div class="fondo-inicio">
        <img src= "{{ asset('../resources/featureds/imagenFondoHome.jpg') }}" class="header-image">
        <h1 class="titulo-principal">SalonesChilpancingo.com</h1>
        <span class="texto-linea">Encuentra el escenario perfecto para tus momentos inolvidables. Explora una variedad de
            salones
            diseñados para celebrar tus eventos con estilo y elegancia.</span>
    </div>

    <div class="center-container">
        <span class="text">Visita nuestra gran variedad de salones</span>
        <hr class="linea">
        <p class="text-complement">Nos especializamos en la organización de eventos sociales. Desde bodas hasta
            conferencias, nuestros salones ofrecen un ambiente sofisticado y elegante. En Salones Classic, hacemos que tu
            evento sea memorable</p>
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
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection()
