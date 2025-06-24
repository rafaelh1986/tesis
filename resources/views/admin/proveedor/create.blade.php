@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Crear Persona</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('proveedor.index')}}" class="btn btn-sm btn-info btn-block">
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
<form action="{{route('proveedor.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-3">
            <label for="razon_social">Razón social</label>
            <input type="text" name="razon_social" id="razon_social" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label for="nit">NIT</label>
            <input type="text" name="nit" id="nit" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="col-md-3">
            <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
        </div>
    </div>
</form>
@endsection