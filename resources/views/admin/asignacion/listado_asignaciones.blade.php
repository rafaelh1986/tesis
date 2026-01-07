@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Listado de asignaciones</h4>
    </div>

</div>
@endsection
@section('contenido')
<form method="GET" class="mb-3" id="filtro-asignaciones">
    <div class="row">
        <div class="col-md-3">
            <select name="empleado_id" id="empleado-select" class="form-control">
                <option value="">-- Todos los empleados --</option>
                @foreach($empleados as $empleado)
                <option value="{{ $empleado->id }}" {{ request('empleado_id') == $empleado->id ? 'selected' : '' }}>
                    {{ $empleado->persona->nombres }} {{ $empleado->persona->apellidos }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="tipo_equipo_id" id="tipo-equipo-select" class="form-control">
                <option value="">-- Todos los tipos de equipo --</option>
                @if(isset($tipos_equipo))
                @foreach($tipos_equipo as $tipo)
                <option value="{{ $tipo->id }}" {{ request('tipo_equipo_id') == $tipo->id ? 'selected' : '' }}>
                    {{ $tipo->nombre }}
                </option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="col-md-1">
            <a href="{{ route('asignacion.exportar_pdf', request()->query()) }}" class="btn btn-success mb-1">
                PDF
            </a>
        </div>
    </div>
</form>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('filtro-asignaciones');
    const empleadoSelect = document.getElementById('empleado-select');
    const tipoSelect = document.getElementById('tipo-equipo-select');

    empleadoSelect.addEventListener('change', function() {
        var empleadoId = this.value;
        tipoSelect.innerHTML = '<option value="">-- Todos los tipos de equipo --</option>';
        form.submit();
    });

    tipoSelect.addEventListener('change', function() {
        form.submit();
    });
});
</script>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Tipo de Equipo</th>
                <th>Equipo</th>
                <th>Serie</th>
                <th>Fecha Recepción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalles as $detalle)
            <tr>
                <td>
                    {{ $detalle->asignacion->empleado->persona->nombres ?? '-' }}
                    {{ $detalle->asignacion->empleado->persona->apellidos ?? '' }}
                </td>
                <td>{{ $detalle->inventario->equipo->modelo->tipo_equipo->nombre ?? '-' }}</td>
                <td>{{ $detalle->inventario->equipo->modelo->nombre_comercial ?? '-' }}</td>
                <td>{{ $detalle->inventario->numero_serie ?? '-' }}</td>
                <td>{{ $detalle->inventario->equipo->fecha_recepcion ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<hr class="sidebar-divider d-none d-sm-block" style color="#b7b9cc">



@endsection