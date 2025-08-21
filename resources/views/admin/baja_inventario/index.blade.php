@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Baja Inventario</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('bajainventario.create')}}" class="btn btn-sm btn-info btn-block">
                                <i class="fas fa-plus"></i>Agregar
        </a>
    </div>
</div>
@endsection
@section('contenido')
<div class="table-responsive">
    <table class="table table-striped" >
        <thead>
            <tr>
                <td><b>Equipo</b></td>
                <td><b>Serie</b></td>
                <td><b>Motivo baja</b></td>
                <td><b>Gestión</b></td>

                <td><b>Estado</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($bajainventarios as $bajainventario)
                <tr>
                    <td>{{$bajainventario->inventario->equipo->modelo->nombre_comercial}}</td>
                    <td>{{$bajainventario->inventario->numero_serie}}</td>
                    <td>{{$bajainventario->motivo_baja->nombre}}</td>
                    <td>{{$bajainventario->gestion}}</td>
                    <td>@if($bajainventario->estado==0)
                            <label for=""style="color:brown">Inactivo</label>
                        @else
                            <label for="">Activo</label>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('bajainventario.show' , $bajainventario->id)}}"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{route('bajainventario.edit' , $bajainventario->id)}}"
                            class="btn btn-sm btn-info">
                            <i class="fas fa-pen"></i>
                        </a>
                        @php
                            if($bajainventario->estado==0)
                            {
                                $icono_delete="redo";
                                $bg_btn = "warning";
                            }
                            else{
                                $icono_delete="trash";
                                $bg_btn = "danger";
                            }
                        @endphp
                        <a href="{{route('bajainventario.destroy' , $bajainventario->id)}}"
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
{{$bajainventarios ->appends(request()->except('page'))->links() }}
@endsection

