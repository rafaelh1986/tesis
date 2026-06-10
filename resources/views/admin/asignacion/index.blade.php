@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Asignación</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('asignacion.create')}}" class="btn btn-sm btn-info btn-block">
            <i class="fas fa-plus"></i>Agregar
        </a>
    </div>
</div>
@endsection
@section('contenido')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <td><b>Asignado</b></td>
                <td><b>Fecha de asignación</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($asignaciones as $asignacion)
            <tr>
                <td>{{$asignacion->empleado->persona->nombres}} {{$asignacion->empleado->persona->apellidos}}</td>
                <td>{{$asignacion->fecha_asignacion}}</td>
                <td>
                    <a href="{{route('asignacion.edit' , $asignacion->id)}}"
                        class="btn btn-sm btn-info">
                        <i class="fas fa-pen"></i>
                    </a>

                    @if ($asignacion->estado == 2)
                    <button type="button" class="btn btn-sm btn-danger" disabled>
                        <i class="fas fa-trash"></i>
                    </button>
                    @else
                    <a href="{{ route('asignacion.destroy', $asignacion->id) }}"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('¿Estas seguro?')">
                        <i class="fas fa-trash"></i>
                    </a>
                    @endif

                    </a>
                    <a href="{{route('asignacion.notaAsignacion' , $asignacion->id)}}"
                        class="btn btn-sm btn-success">
                        <i class="fas fa-print"></i>
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
{{ $asignaciones->appends(request()->except('page'))->links() }}
@endsection