@extends('template.index')
@section('encabezado')
<div class="d-flex justify-content-between align-items-center">
    <h4 class="m-0 font-weight-bold text-primary">Crear asignacion</h4>
    <a href="{{route('asignacion.index')}}" class="btn btn-sm btn-info">
        <i class="fas fa-arrow-left"></i>Volver
    </a>
</div>
@endsection
@section('contenido')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form id="form-crear-asignacion" action="{{route('asignacion.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-3">
            <label for="id_empleado">asignar a:</label>
            <select name="id_empleado" id="id_empleado" class="form-control" required>
                <option value="">Seleccionar</option>
                @foreach($empleados as $empleado)
                <option value="{{$empleado->id}}" data-fecha-ingreso="{{$empleado->fecha_ingreso}}">
                    {{$empleado->persona->nombres}} {{$empleado->persona->apellidos}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="fecha_asignacion">Fecha de asignación</label>
            <input type="date" name="fecha_asignacion" id="fecha_asignacion" class="form-control">
            <div id="fecha_asignacion_alert" class="alert alert-danger mt-2" role="alert" style="display:none;"></div>
        </div>

        <div class="col-md-3">
            <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
        </div>
    </div>
</form>
<script>
    const empleadoSelect = document.getElementById('id_empleado');
    const fechaAsignacionInput = document.getElementById('fecha_asignacion');

    function actualizarMinMaxFechaAsignacion() {
        const selectedOption = empleadoSelect.options[empleadoSelect.selectedIndex];
        const fechaIngreso = selectedOption.dataset.fechaIngreso;
        const hoy = new Date().toISOString().slice(0, 10);

        // establecer max a hoy
        fechaAsignacionInput.max = hoy;

        if (fechaIngreso) {
            fechaAsignacionInput.min = fechaIngreso;
            if (fechaAsignacionInput.value && fechaAsignacionInput.value < fechaIngreso) {
                fechaAsignacionInput.value = fechaIngreso;
            }
        } else {
            fechaAsignacionInput.removeAttribute('min');
        }

        // si la fecha actual es mayor que hoy, ajustarla a hoy
        if (fechaAsignacionInput.value && fechaAsignacionInput.value > hoy) {
            fechaAsignacionInput.value = hoy;
        }
    }

    empleadoSelect.addEventListener('change', actualizarMinMaxFechaAsignacion);
    actualizarMinMaxFechaAsignacion();

    // alerta y validación en cliente
    const fechaAsignacionAlert = document.getElementById('fecha_asignacion_alert');

    function validarFechaAsignacion() {
        const min = fechaAsignacionInput.min || null;
        const max = fechaAsignacionInput.max || null;
        const val = fechaAsignacionInput.value;
        if (!val) {
            fechaAsignacionAlert.style.display = 'none';
            return true;
        }
        if (min && val < min) {
            fechaAsignacionAlert.textContent = 'La fecha de asignación no puede ser anterior a la fecha de ingreso del empleado.';
            fechaAsignacionAlert.style.display = '';
            return false;
        }
        if (max && val > max) {
            fechaAsignacionAlert.textContent = 'La fecha de asignación no puede ser mayor a la fecha actual.';
            fechaAsignacionAlert.style.display = '';
            return false;
        }
        fechaAsignacionAlert.style.display = 'none';
        return true;
    }

    fechaAsignacionInput.addEventListener('change', validarFechaAsignacion);

    document.getElementById('form-crear-asignacion').addEventListener('submit', function(e) {
        if (!validarFechaAsignacion()) {
            e.preventDefault();
            fechaAsignacionInput.focus();
        }
    });
</script>
@endsection