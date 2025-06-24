@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Crear usuario</h4>
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
<form action="{{route('usuario.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-3">
            <label for="">Persona</label>
            <select name="id_persona" id="" class="form-control" required>
                <option value="">Seleccionar</option>
                @foreach($personas as $persona)
                <option value="{{$persona->id}}">{{$persona->nombres.' '.$persona->apellidos}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Email</label>
            <input type="email" name="email" id="" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label for="">Password</label>
            <input type="password" name="password" id="" class="form-control">
        </div>
        <div class="col-md-3">
            <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
        </div>
    </div>
</form>
@endsection