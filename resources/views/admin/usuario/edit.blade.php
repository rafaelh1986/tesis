@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Editar usuario</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('usuario.index')}}" class="btn btn-sm btn-info btn-block">
            <i class="fas fa-arrow-left"></i>Volver
        </a>
    </div>
</div>
@endsection
@section('contenido')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{route('usuario.update', $usuario->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-3">
            <label for="persona">Persona</label>
            <input type="text" name="" id="persona" class="form-control" readonly
                value="{{$usuario->persona->nombres.' '.$usuario->persona->apellidos}}">
        </div>
        <div class="col-md-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                value="{{$usuario->email}}" required>
        </div>
        <div class="col-md-3">
            <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
        </div>
    </div>
</form>
<hr>
<form action="{{route('usuario.asignar_roles')}}" method="POST">
    @csrf
    <div class="row">
        @foreach($roles as $rol)
        <div class="col-md-3">
            <input type="checkbox" name="roles[]" id="rol_{{$rol->id}}" value="{{$rol->name}}"
                {{$usuario->hasRole($rol->name)? 'checked' : ''}}> {{$rol->name}}
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-6">
            <input type="hidden" name="usuario_id" value="{{$usuario->id}}">
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <input type="submit" value="Asignar permisos" class="btn btn-success btn-block">
        </div>

    </div>
</form>
@endsection