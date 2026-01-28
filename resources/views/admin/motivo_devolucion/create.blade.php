@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Crear motivo de devolución</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('motivo_devolucion.index')}}" class="btn btn-sm btn-info btn-block">
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
<form action="{{route('motivo_devolucion.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-6">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4">{{ old('descripcion') }}</textarea>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2">
            <input type="submit" value="Guardar" class="btn btn-success btn-block">
        </div>
    </div>
</form>
@endsection
