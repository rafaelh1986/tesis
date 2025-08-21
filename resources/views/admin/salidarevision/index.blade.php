@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Salida Revisión</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('salida_revision.create')}}" class="btn btn-sm btn-info btn-block">
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
                <td><b>Equipo</b></td>
                <td><b>Serie</b></td>
                <td><b>Proveedor</b></td>
                <td><b>Fecha salida</b></td>
                <td><b>Descripción</b></td>
                <td><b>Estado</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($salidarevisiones as $salidarevision)
            <tr>
                <td>{{$salidarevision->inventario->equipo->modelo->nombre_comercial}}</td>
                <td>{{$salidarevision->inventario->numero_serie}}</td>
                <td>{{$salidarevision->proveedor->razon_social}}</td>
                <td>{{$salidarevision->fecha_salida}}</td>
                <td>{{$salidarevision->descripcion}}</td>
                <td>@if($salidarevision->estado==0)
                    <label for="" style="color:brown">Inactivo</label>
                    @else
                    <label for="">Activo</label>
                    @endif
                </td>
                <td>
                    <a href="{{route('salida_revision.show' , $salidarevision->id)}}"
                        class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>

                    <a href="{{route('salida_revision.edit' , $salidarevision->id)}}"
                        class="btn btn-sm btn-info">
                        <i class="fas fa-pen"></i>
                    </a>
                    @php
                    if($salidarevision->estado==0)
                    {
                    $icono_delete="redo";
                    $bg_btn = "warning";
                    $msj = "restaurar";
                    }
                    else{
                    $icono_delete="trash";
                    $bg_btn = "danger";
                    $msj = "eliminar";
                    }
                    @endphp
                    <a href="{{route('salida_revision.destroy' , $salidarevision->id)}}"
                        class="btn btn-sm btn-{{$bg_btn}}" onclick="return confirm('¿Estas seguro?')">
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
{{$salidarevisiones -> appends(request()->except('page'))->links() }}
@endsection