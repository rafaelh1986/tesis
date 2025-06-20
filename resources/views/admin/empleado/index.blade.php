@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Empleado</h4>
    </div>
    <div class="col-md-2">
        <a href="{{route('empleado.create')}}" class="btn btn-sm btn-info btn-block">
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
                <td><b>Nombre completo</b></td>
                <td><b>Área</b></td>
                <td><b>Cargo</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{$empleado->persona->nombres.' '.$empleado->persona->apellidos}}</td>
                    <td>{{$empleado->area->nombre}}</td>
                    <td>{{$empleado->cargo->nombre}}</td>
                    <td>
                        <a href="{{route('empleado.show' , $empleado->id)}}"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        
                        <a href="{{route('empleado.edit' , $empleado->id)}}"
                            class="btn btn-sm btn-info">
                            <i class="fas fa-pen"></i>
                        </a>
                        @php
                            if($empleado->estado==0)
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
                        <a href="{{route('empleado.destroy' , $empleado->id)}}" 
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
{{$empleados -> links()}}
@endsection

