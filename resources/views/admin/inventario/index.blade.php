@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Inventario</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('inventario.create')}}" class="btn btn-sm btn-info btn-block">
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
                <td><b>Tipo</b></td>
                <td><b>Equipo</b></td>
                <td><b>Número de serie</b></td>
                <td><b>Código de AF</b></td>
                <td><b>Estado</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($inventarios as $inventario)
                <tr>
                    <td>
                        {{$inventario->equipo && $inventario->equipo->modelo && $inventario->equipo->modelo->tipo_equipo ? 
                        $inventario->equipo->modelo->tipo_equipo->nombre: '-'}}
                    </td>
                    <td>
                        {{ $inventario->equipo && $inventario->equipo->modelo ? $inventario->equipo->modelo->nombre_comercial : '-' }}
                    </td>
                    <td>{{$inventario->numero_serie}}</td>
                    <td>{{$inventario->codigo_activo_fijo}}</td>
                    <td>
                        @if($inventario->estado==2)
                            <label style="color:blue">Asignado</label>
                        @elseif($inventario->estado==1)
                            <label style="color:green">Disponible</label>
                        @elseif($inventario->estado==3)
                            <label style="color:orange">No disponible</label>
                        @else
                            <label style="color:red">Baja</label>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('inventario.show' , $inventario->id)}}"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        
                        <a href="{{route('inventario.edit' , $inventario->id)}}"
                            class="btn btn-sm btn-info">
                            <i class="fas fa-pen"></i>
                        </a>
                        @php
                            if($inventario->estado==0)
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
                        @if($inventario->estado == 1)
                            <a href="{{route('inventario.destroy' , $inventario->id)}}"
                                class="btn btn-sm btn-{{$bg_btn}}" onclick="return confirm('¿Estas seguro de {{$msj}} este inventario?')">
                                <i class="fas fa-{{$icono_delete}}"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                
            @endforeach
        </tbody>
    </table>
</div>
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
<hr class="sidebar-divider d-none d-sm-block" style color="#b7b9cc">
{{ $inventarios->appends(request()->except('page'))->links() }}
@endsection

