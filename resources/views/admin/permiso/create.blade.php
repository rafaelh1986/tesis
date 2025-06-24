@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Crear Permisos</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('permiso.index')}}" class="btn btn-sm btn-info btn-block">
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
<form action="{{route('permiso.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-3">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" required placeholder="Ingrese el nombre del permiso">
        </div>
        <div class="col-md-3">
            <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
        </div>
    </div>
</form>
@endsection