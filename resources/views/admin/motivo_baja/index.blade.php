@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Motivo baja</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('motivo_baja.create')}}" class="btn btn-sm btn-info btn-block">
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
                <td><b>Id</b></td>
                <td><b>Nombre</b></td>
                <td><b>Descripción</b></td>
                <td><b>Estado</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($motivo_bajas as $motivo_baja)
            <tr>
                <td>{{$motivo_baja->id}}</td>
                <td>{{$motivo_baja->nombre}}</td>
                <td>{{$motivo_baja->descripcion}}</td>
                <td>@if($motivo_baja->estado==0)
                    <label for="" style="color:brown">Inactivo</label>
                    @else
                    <label for="">Activo</label>
                    @endif
                </td>
                <td>
                    <a href="{{route('motivo_baja.show' , $motivo_baja->id)}}"
                        class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{route('motivo_baja.edit' , $motivo_baja->id)}}"
                        class="btn btn-sm btn-info">
                        <i class="fas fa-pen"></i>
                    </a>
                    @php
                    if($motivo_baja->estado==0)
                    {
                    $icono_delete="redo";
                    $bg_btn = "warning";
                    }
                    else{
                    $icono_delete="trash";
                    $bg_btn = "danger";
                    }
                    @endphp
                    <a href="{{route('motivo_baja.destroy' , $motivo_baja->id)}}"
                        class="btn btn-sm btn-{{$bg_btn}}" onclick="return confirm('¿Estas seguro?')">
                        <i class="fas fa-{{$icono_delete}}"></i>
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
<div class="d-flex justify-content-center mt-3">{{$motivo_bajas -> appends(request()->except('page'))->links() }}</div>
@endsection