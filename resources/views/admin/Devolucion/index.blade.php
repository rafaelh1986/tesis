@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Devoluciones de equipos</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('devolucion.create')}}" class="btn btn-sm btn-info btn-block">
            <i class="fas fa-plus"></i>Registrar devolución
        </a>
    </div>
</div>
@endsection
@section('contenido')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <td><b>Id</b></td>
                <td><b>Empleado</b></td>
                <td><b>Equipo</b></td>
                <td><b>Motivo</b></td>
                <td><b>Fecha devolución</b></td>
                <td><b>Usuario</b></td>
                <td><b>Estado</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($devoluciones as $devolucion)
            <tr>
                <td>{{$devolucion->id}}</td>
                <td>{{$devolucion->detalleAsignacion->asignacion->empleado->persona->nombres}} {{$devolucion->detalleAsignacion->asignacion->empleado->persona->apellidos}}</td>
                <td>{{$devolucion->detalleAsignacion->inventario->equipo->nombre}}</td>
                <td>{{$devolucion->motivo->nombre}}</td>
                <td>{{$devolucion->fecha_devolucion}}</td>
                <td>{{$devolucion->usuario->name}}</td>
                <td>@if($devolucion->estado==0)
                    <label for="" style="color:brown">Inactivo</label>
                    @else
                    <label for="">Activo</label>
                    @endif
                </td>
                <td>
                    <a href="{{route('devolucion.show' , $devolucion->id)}}"
                        class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{route('devolucion.edit' , $devolucion->id)}}"
                        class="btn btn-sm btn-info">
                        <i class="fas fa-pen"></i>
                    </a>
                    @php
                    if($devolucion->estado==0)
                    {
                    $icono_delete="redo";
                    $bg_btn = "warning";
                    }
                    else{
                    $icono_delete="trash";
                    $bg_btn = "danger";
                    }
                    @endphp
                    <a href="{{route('devolucion.destroy' , $devolucion->id)}}"
                        class="btn btn-sm btn-{{$bg_btn}}" onclick="return confirm('¿Estás seguro?')">
                        <i class="fas fa-{{$icono_delete}}"></i>
                    </a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    <form method="GET" class="form-inline mb-2">
        <label for="per_page" class="mr-2">Mostrar</label>
        <select name="per_page" id="per_page" class="form-control mr-2" onchange="this.form.submit()">
            <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
        </select>
        <span>registros por página</span>
    </form>
</div>
<hr class="sidebar-divider d-none d-sm-block" style color="#b7b9cc">
{{ $devoluciones->appends(request()->except('page'))->links() }}
@endsection
