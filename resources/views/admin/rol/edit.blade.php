@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Editar Roles</h4>
        </div>
        <div class="col-md-2">
            <a href="{{route('rol.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('rol.update', $rol->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-3" >
                <label for="">Rol</label>
                <input type="text" name="name" id="" class="form-control" 
                    value="{{$rol->name}}" required>
            </div>
            <div class="col-md-2">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
    <hr>
    <form action="{{route('rol.permiso')}}" method="POST">
        @csrf
        <div class="row">
            @foreach($permisos as $permiso)
                <div class="col-md-3">
                    <input type="checkbox" name="permisos[]" id="" value="{{$permiso->name}}"
                        {{$rol->hasPermissionTo($permiso->name) ? 'checked' : ''}}> 
                        {{$permiso->name}}
                </div>
            @endforeach
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" name="rol_id" value= "{{$rol->id}}">
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-2">
                <input type="submit" value="Asignar permisos" class="btn btn-success btn-block">
            </div>
            
        </div>
    </form>
@endsection

