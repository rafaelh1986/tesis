@extends('template.index')
@section('encabezado')
<div class="d-flex justify-content-between align-items-center">
    <h4 class="m-0 font-weight-bold text-primary">Asignación</h4>
    <a href="{{route('asignacion.create')}}" class="btn btn-sm btn-info">
        <i class="fas fa-plus"></i>Agregar
    </a>
</div>
@endsection
@section('contenido')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <td><b>ID</b></td>
                <td><b>Asignado</b></td>
                <td><b>Área</b></td>
                <td><b>Fecha de asignación</b></td>
                <td><b>Estado</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($asignaciones as $asignacion)
            <tr>    
                <td>{{$asignacion->id}}</td>
                <td>{{$asignacion->empleado->persona->nombres}} {{$asignacion->empleado->persona->apellidos}}</td>
                <td>{{$asignacion->empleado->area->nombre}}</td>
                <td>{{ \Carbon\Carbon::parse($asignacion->fecha_asignacion)->format('d/m/Y') }}</td>
                <td>
                    @if ($asignacion->estado == 1)
                    <span class="badge badge-success px-3 py-2 fs-6">Activo</span>
                    @elseif ($asignacion->estado == 2)
                    <span class="badge badge-danger px-3 py-2 fs-6">Inactivo</span>
                    @else
                    <span class="badge badge-secondary px-3 py-2 fs-6">Pendiente</span>
                    @endif
                </td>
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
    <form method="GET" class="d-flex flex-column flex-sm-row align-items-center mb-2">
        <div class="d-flex flex-column flex-sm-row align-items-center w-100">
            <label for="per_page" class="mr-sm-2 mb-2 mb-sm-0">Mostrar</label>
            <select name="per_page" id="per_page" class="form-control mr-sm-2 mb-2 mb-sm-0" onchange="this.form.submit()">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
            </select>
        </div>
        <small class="text-muted d-block d-sm-inline mt-2 mt-sm-0">registros por página</small>
    </form>
</div>
<hr class="sidebar-divider d-none d-sm-block" style color="#b7b9cc">
<div class="d-flex justify-content-center mt-3">{{ $asignaciones->appends(request()->except('page'))->links() }}</div>
@endsection