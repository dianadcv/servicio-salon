@extends('layouts.plantilla')

@section('title', 'Home')

<link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">

@section('content')

    <h1>Hacer una reservación</h1>

    <form method="POST" action="{{ route('renta.upload', ['id' => $renta->id]) }}">
        @csrf
        <!-- Usuario -->
        <input type="hidden" id="user_id" name="user_id" value="{{ $renta->id }}">
        <label for="user_name">Nombre de Usuario:</label>
        <input type="text" id="user_name" name="user_name" value="{{ $renta->user_name }}" required readonly><br><br>
        <label for="user_last_name">Apellido de Usuario:</label>
        <input type="text" id="user_last_name" name="user_last_name" value="{{ $renta->user_last_name }}" required
            readonly><br><br>

        <!-- Salón -->
        <input type="hidden" id="salon_id" name="salon_id" value="{{ $renta->id }}">
        <label for="salon_name">Nombre del Salón:</label>
        <input type="text" id="salon_name" name="salon_name" value="{{ $renta->salon_name }}" required readonly><br><br>

        <!-- Otros campos -->
        <label for="meseros">Número de Meseros:</label>
        <input type="number" id="meseros" name="meseros" value="{{ $renta->meseros }}" required><br><br>

        <label for="price">Precio:</label>
        <input type="number" id="price" name="price" step="0.01" value="{{ $renta->price }}" required
            readonly><br><br>

        <label for="capacity">Capacidad:</label>
        <input type="number" id="capacity" name="capacity" value="{{ $renta->capacity }}" oninput="limitCapacity()"
            required><br><br>

        <label for="numero_de_horas">Número de Horas:</label>
        <input type="number" id="numero_de_horas" name="numero_de_horas" value="{{ $renta->numero_de_horas }}"
            required><br><br>

        <label for="fecha">Fecha:</label>
        <input type="text" id="fecha" name="fecha" value="{{ $renta->fecha }}" required><br><br>

        <div class="button-container"><button type="submit" class="btn">Guardar</button></div>


    </form>


@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

<script>
    var fechasOcupadas = {!! json_encode($renta->pluck('fecha')) !!};

    $(function() {
        $("#fecha").datepicker({
            minDate: 0,
            dateFormat: "yy-mm-dd",
            beforeShowDay: function(date) {
                var stringDate = $.datepicker.formatDate("yy-mm-dd", date);
                var isOccupied = fechasOcupadas.indexOf(stringDate) != -1;
                var colorClass = isOccupied ? "ocupada" : "";
                return [!isOccupied, colorClass];
            }
        });


        $("#fecha").on("blur", function() {
            var fechaInput = $(this);
            var mensaje = $("#mensajeFechaVacia");
            if (fechaInput.val() === "") {
                mensaje.show();
            } else {
                mensaje.hide();
            }
        });
    });
</script>

<script>
    var horasAnteriores = parseInt(document.getElementById("numero_de_horas").value);

    document.getElementById("numero_de_horas").addEventListener("input", function() {

        var horas = parseInt(document.getElementById("numero_de_horas").value);
        var horaExtra = 100;
        var precioOriginal = {{ $renta->salon_price }};


        if (isNaN(horas) || horas <= 5) {
            horas = 5;
            document.getElementById("numero_de_horas").value = horas;
        }

        var precioActual = 500 + ((horas - 5) * horaExtra);

        document.getElementById("price").value = precioActual.toFixed(2);
        console.log("Nuevas horas: " + horas);
        console.log("Original: " + precioOriginal);
        console.log("Precio actual: " + precioActual);

        horasAnteriores = horas;
    });
</script>

<script>
    function limitCapacity() {
        var c = document.getElementById("capacity").value;
        var capacidadMaxima = {{ $renta->capacity }};

        if (c > capacidadMaxima) {
            document.getElementById("capacity").value = capacidadMaxima;
        } else if (c < 0) {
            c = 1;
            document.getElementById("capacity").value = c;
        }
    }
</script>