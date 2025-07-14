@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Listado de asignaciones</h4>
    </div>

</div>
@endsection
@section('contenido')
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Equipo</th>
                <th>Tipo de Equipo</th>
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
                <td>{{ $detalle->inventario->equipo->modelo->nombre_comercial ?? '-' }}</td>
                <td>{{ $detalle->inventario->equipo->modelo->tipo_equipo->nombre ?? '-' }}</td>
                <td>{{ $detalle->inventario->equipo->fecha_recepcion ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<hr class="sidebar-divider d-none d-sm-block" style color="#b7b9cc">

@endsection