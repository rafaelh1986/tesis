@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Editar devolución</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('devolucion.index')}}" class="btn btn-sm btn-info btn-block">
            <i class="fas fa-arrow-left"></i>Volver
        </a>
    </div>
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
<form id="form-editar-devolucion" action="{{route('devolucion.update', $devolucion->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <label for="id_detalle_asignacion">Asignación</label>
            <input type="text" class="form-control" disabled value="{{$devolucion->detalleAsignacion->asignacion->empleado->persona->nombres}} {{$devolucion->detalleAsignacion->asignacion->empleado->persona->apellidos}} - {{$devolucion->detalleAsignacion->inventario->equipo->nombre}}">
            <input type="hidden" name="id_detalle_asignacion" value="{{$devolucion->id_detalle_asignacion}}">
        </div>
        <div class="col-md-6">
            <label for="id_motivo_devolucion">Motivo de devolución</label>
            <select name="id_motivo_devolucion" id="id_motivo_devolucion" class="form-control" required>
                <option value="">-- Seleccionar --</option>
                @foreach($motivo_devolucion as $motivo)
                <option value="{{$motivo->id}}" {{$devolucion->id_motivo_devolucion == $motivo->id ? 'selected' : ''}}>{{$motivo->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="fecha_devolucion">Fecha de devolución</label>
            <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="form-control"
                value="{{ $devolucion->fecha_devolucion }}"
                min="{{ $devolucion->detalleAsignacion->asignacion->empleado->fecha_ingreso }}"
                max="{{ date('Y-m-d') }}"
                required>
            <div id="fecha_devolucion_alert" class="alert alert-danger mt-2" role="alert" style="display:none;"></div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="4">{{ $devolucion->observaciones }}</textarea>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2">
            <input type="submit" value="Actualizar" class="btn btn-success btn-block">
        </div>
    </div>
</form>
<script>
    // Ajuste por si el valor actual está fuera de rango
    (function() {
        const input = document.getElementById('fecha_devolucion');
        if (!input) return;
        const min = input.getAttribute('min');
        const max = input.getAttribute('max');
        if (input.value && min && input.value < min) input.value = min;
        if (input.value && max && input.value > max) input.value = max;
    })();
</script>
<script>
    // Validación cliente y bloqueo de envío
    (function() {
        const input = document.getElementById('fecha_devolucion');
        const alertDiv = document.getElementById('fecha_devolucion_alert');
        const form = document.getElementById('form-editar-devolucion');
        if (!input || !form) return;
        function validar() {
            const min = input.getAttribute('min');
            const max = input.getAttribute('max');
            const val = input.value;
            if (!val) { alertDiv.style.display = 'none'; return true; }
            if (min && val < min) { alertDiv.textContent = 'La fecha de devolución no puede ser anterior a la fecha de ingreso del empleado.'; alertDiv.style.display = ''; return false; }
            if (max && val > max) { alertDiv.textContent = 'La fecha de devolución no puede ser mayor a la fecha actual.'; alertDiv.style.display = ''; return false; }
            alertDiv.style.display = 'none'; return true;
        }
        input.addEventListener('change', validar);
        form.addEventListener('submit', function(e) { if (!validar()) { e.preventDefault(); input.focus(); } });
    })();
</script>
@endsection
