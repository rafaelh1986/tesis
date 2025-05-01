@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Usuario</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('usuario.create')}}" class="btn btn-sm btn-info btn-block">
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
                <td><b>CI</b></td>
                <td><b>Nombre completo</b></td>
                <td><b>Usuario</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->persona->ci}}</td>
                    <td>{{$usuario->persona->nombres.' '.$usuario->persona->apellidos}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>
                        <a href="{{route('usuario.show' , $usuario->id)}}"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{route('usuario.reset_password' , $usuario->id)}}"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-unlock-alt"></i>
                        </a>
                        <a href="{{route('usuario.edit' , $usuario->id)}}"
                            class="btn btn-sm btn-info">
                            <i class="fas fa-pen"></i>
                        </a>
                        @php
                            if($usuario->estado==0)
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
                        <a href="{{route('usuario.destroy' , $usuario->id)}}" 
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
{{$usuarios -> links()}}
@endsection

