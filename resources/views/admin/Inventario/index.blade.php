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
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($inventarios as $inventario)
                <tr>
                    <td>{{$inventario->equipo->tipo_equipo->nombre}}</td>
                    <td>{{$inventario->equipo->modelo->nombre_comercial}}</td>
                    <td>{{$inventario->numero_serie}}</td>
                    <td>{{$inventario->codigo_activo_fijo}}</td>
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
                        <a href="{{route('inventario.destroy' , $inventario->id)}}" 
                            class="btn btn-sm btn-{{$bg_btn}}" onclick="return confirm('¿Estas seguro?')">
                            <i class="fas fa-{{$icono_delete}}"></i>
                        </a>
                    </td>
                </tr>
                
            @endforeach
        </tbody>
    </table>
</div>
<hr class="sidebar-divider d-none d-sm-block" style color="#b7b9cc">
{{$inventarios -> links()}}
@endsection

