@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Área</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('area.create')}}" class="btn btn-sm btn-info btn-block">
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
                <td><b>Id</b></td>
                <td><b>Descripción</b></td>
                
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($areas as $area)
                <tr>
                    <td>{{$area->id}}</td>
                    <td>{{$area->nombre}}</td>
                    
                    <td>
                        <a href="{{route('area.show' , $area->id)}}"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{route('area.edit' , $area->id)}}"
                            class="btn btn-sm btn-info">
                            <i class="fas fa-pen"></i>
                        </a>
                        @php
                            if($area->estado==0)
                            {
                                $icono_delete="redo";
                                $bg_btn = "warning";
                            }
                            else{
                                $icono_delete="trash";
                                $bg_btn = "danger";
                            }
                        @endphp
                        <a href="{{route('area.destroy' , $area->id)}}"
                            class="btn btn-sm btn-{{$bg_btn}}" onclick="return confirm('¿Estas seguro?')">
                            <i class="fas fa-{{$icono_delete}}"></i>
                        </a>
                        <!--<button onclick="Eliminaritem()" class="btn btn-sm btn-{{$bg_btn}}">
                        <i class="fas fa-{{$icono_delete}}"></i>
                        </button>-->
                    </td>
                </tr>
                
            @endforeach
        </tbody>
    </table>
</div>

<hr class="sidebar-divider d-none d-sm-block" style color="#b7b9cc">
{{$areas -> links()}}
@endsection

