@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Registrar devolución de equipo</h4>
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
<form action="{{route('devolucion.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-6">
            <label for="id_empleado">Empleado</label>
            <select name="id_empleado" id="id_empleado" class="form-control" required>
                <option value="">-- Seleccionar empleado --</option>
                @foreach($empleadosConEquipos as $empleado)
                <option value="{{ $empleado['empleado_id'] }}">
                    {{ $empleado['nombre'] }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="id_detalle_asignacion">Equipo asignado</label>
            <select name="id_detalle_asignacion" id="id_detalle_asignacion" class="form-control" required>
                <option value="">-- Seleccionar equipo --</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="id_motivo_devolucion">Motivo de devolución</label>
            <select name="id_motivo_devolucion" id="id_motivo_devolucion" class="form-control" required>
                <option value="">-- Seleccionar --</option>
                @foreach($motivo_devolucion as $motivo)
                <option value="{{$motivo->id}}">{{$motivo->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="fecha_devolucion">Fecha de devolución</label>
            <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="form-control" value="{{ old('fecha_devolucion') }}" required>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="4">{{ old('observaciones') }}</textarea>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-2">
            <input type="submit" value="Guardar" class="btn btn-success btn-block">
        </div>
    </div>
</form>
<script>
    const empleadosConEquipos = @json($empleadosConEquipos);
    const empleadoSelect = document.getElementById('id_empleado');
    const detalleSelect = document.getElementById('id_detalle_asignacion');

    empleadoSelect.addEventListener('change', function() {
        const empleadoId = parseInt(this.value);
        detalleSelect.innerHTML = '<option value="">-- Seleccionar equipo --</option>';

        if (!empleadoId || empleadoId === 0) {
            return;
        }

        const empleado = empleadosConEquipos.find(item => parseInt(item.empleado_id) === empleadoId);
        
        if (!empleado || !empleado.equipos || empleado.equipos.length === 0) {
            detalleSelect.innerHTML = '<option value="">-- No hay equipos asignados --</option>';
            return;
        }

        empleado.equipos.forEach(equipo => {
            const option = document.createElement('option');
            option.value = equipo.detalle_id;
            option.textContent = equipo.texto;
            detalleSelect.appendChild(option);
        });
    });
</script>
@endsection