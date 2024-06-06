@extends('layouts.plantilla')

@section('title', 'Home')

<link rel="stylesheet" href="{{ asset('../resources/css/reservación.css') }}">

@section('content')
    <div class="content">
        <h1>Reservas</h1>

        <a href="{{ route('salones.index', $id) }}" class="btn">Ir a salones</a>
        <img src= "{{ asset('../resources/featureds/diana.jpeg') }}" class="header-image">

        @if ($users->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Apellido del Usuario</th>
                        <th>Salón</th>
                        <th>Meseros</th>
                        <th>Precio</th>
                        <th>Capacidad</th>
                        <th>Número de Horas</th>
                        <th>Fecha</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->user_last_name }}</td>
                            <td>{{ $user->salon_name }}</td>
                            <td>{{ $user->meseros }}</td>
                            <td>{{ $user->price }}</td>
                            <td>{{ $user->capacity }}</td>
                            <td>{{ $user->numero_de_horas }}</td>
                            <td>{{ $user->fecha }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                <a href="{{ route('renta.edit', $user->id) }}" class="btn btn-primary">Upload</a>
                                <a href="{{ route('renta.delete', $user->id) }}" class="btn btn-primary">Delete</a>
                                <!--<a href="{{ route('renta.pdf', $user->id) }}" class="btn btn-primary">generar</a>-->>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay reservas disponibles.</p>
        @endif
    </div>

@endsection
