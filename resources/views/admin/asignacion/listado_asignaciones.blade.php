@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Listado de asignaciones</h4>
    </div>

</div>
@endsection
@section('contenido')
<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <select name="empleado_id" class="form-control">
                <option value="">-- Todos los empleados --</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}" {{ request('empleado_id') == $empleado->id ? 'selected' : '' }}>
                        {{ $empleado->persona->nombres }} {{ $empleado->persona->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="tipo_equipo_id" class="form-control">
                <option value="">-- Todos los tipos de equipo --</option>
                @foreach($tipos_equipo as $tipo)
                    <option value="{{ $tipo->id }}" {{ request('tipo_equipo_id') == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="equipo_id" class="form-control">
                <option value="">-- Todos los equipos --</option>
                @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}" {{ request('equipo_id') == $equipo->id ? 'selected' : '' }}>
                        {{ $equipo->modelo->nombre_comercial ?? 'Equipo '.$equipo->id }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="fecha_recepcion" class="form-control" value="{{ request('fecha_recepcion') }}">
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </div>
</form>
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