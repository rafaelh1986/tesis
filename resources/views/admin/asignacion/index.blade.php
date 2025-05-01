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
    <table class="table table-striped" >
        <thead>
            <tr>
                <td><b>Asignado</b></td>
                <td><b>fecha asignación</b></td>
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
                        @php
                            if($asignacion->estado==0)
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
                        <a href="{{route('asignacion.destroy' , $asignacion->id)}}" 
                            class="btn btn-sm btn-{{$bg_btn}}" onclick="return confirm('¿Estas seguro?')">
                            <i class="fas fa-{{$icono_delete}}"></i>
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
</div>
<hr class="sidebar-divider d-none d-sm-block" style color="#b7b9cc">
{{$asignaciones -> links()}}
@endsection

