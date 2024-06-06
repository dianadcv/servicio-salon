<link rel="stylesheet" href="{{ asset('../resources/css/calendario.css') }}">


<form method="POST" action="{{ route('renta.create', $users->id) }}">
    @csrf

    <h1>Hacer una reservación</h1>

    <!-- Usuario -->
    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
    <label for="user_name">Nombre de Usuario:</label>
    <input type="text" id="user_name" name="user_name" value="{{ $user->name }}" required readonly><br><br>
    <label for="user_last_name">Apellido de Usuario:</label>
    <input type="text" id="user_last_name" name="user_last_name" value="{{ $user->last_name }}" required
        readonly><br><br>

    <!-- Salón -->
    <input type="hidden" id="salon_id" name="salon_id" value="{{ $salon->id }}">
    <label for="salon_name">Nombre del Salón:</label>
    <input type="text" id="salon_name" name="salon_name" value="{{ $salon->name }}" required readonly><br><br>

    <!-- Otros campos -->
    <label for="meseros">Número de Meseros:</label>
    <input type="number" id="meseros" name="meseros" required><br><br>
    <label for="price">Precio:</label>
    <input type="number" id="price" name="price" step="0.01" value="{{ $salon->price }}" required
        readonly><br><br>

    <label for="capacity">Capacidad:</label>
    <input type="number" id="capacity" name="capacity" oninput="limitCapacity()" required><br><br>


    <label for="numero_de_horas">Número de Horas:</label>
    <input type="number" id="numero_de_horas" name="numero_de_horas" value=5 oninput="calculatePrice()"
        required><br><br>

    <label for="fecha">Fecha:</label>
    <input id="fecha" name="fecha" type="text" required><br><br>


    <input type="hidden" id="salon_price" name="salon_price" value="{{ $salon->price }}">

    <button type="submit">Guardar</button>

</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

<script>
    var fechasOcupadas = {!! json_encode($rentas->pluck('fecha')) !!};

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
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('fecha').min = today;

    var fechasOcupadas = {!! json_encode($rentas->pluck('fecha')) !!};

    function validarFecha() {
        var fechaSeleccionada = document.getElementById('fecha').value;
        if (fechasOcupadas.includes(fechaSeleccionada)) {
            document.getElementById('fecha').classList.add('fecha-ocupada');
            document.getElementById('fecha').setCustomValidity('Esta fecha ya está ocupada');
        } else {
            document.getElementById('fecha').classList.remove('fecha-ocupada');
            document.getElementById('fecha').setCustomValidity('');
        }
    }
    document.getElementById('fecha').addEventListener('input', validarFecha);
</script>

<script>
    function calculatePrice() {
        var horas = document.getElementById("numero_de_horas").value;
        if (horas < 5) {
            horas = 5;
            document.getElementById("numero_de_horas").value = horas;
        }
        var precioOriginal = {{ $salon->price }};
        var precioExtraPorHora = 1200;
        var precioTotal = precioOriginal + ((horas - 5) * precioExtraPorHora);
        document.getElementById("price").value = precioTotal.toFixed(2);
    }

    function limitCapacity() {
        var c = document.getElementById("capacity").value;
        var capacidadMaxima = {{ $salon->capacity }};

        if (c > capacidadMaxima) {
            document.getElementById("capacity").value = capacidadMaxima;
        } else if (c < 0) {
            c = 1;
            document.getElementById("capacity").value = c;
        }
    }
</script>
