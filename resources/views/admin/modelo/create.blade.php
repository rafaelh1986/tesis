@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Crear modelo</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('modelo.index')}}" class="btn btn-sm btn-info btn-block">
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
<form action="{{route('modelo.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-3">
            <label for="">Tipo de equipo</label>
            <select name="id_tipo_equipo" id="tipo_equipo" class="form-control" required>
                <option value="">Seleccionar</option>
                @foreach($tipo_equipos as $tipo_equipo)
                <option value="{{$tipo_equipo->id}}">{{$tipo_equipo->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Nombre comercial</label>
            <input type="text" name="nombre_comercial" id="" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label for="">Nombre técnico</label>
            <input type="text" name="nombre_tecnico" id="" class="form-control" required>
        </div>
        <div class="col-md-3">
            <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
        </div>
    </div>
</form>
@endsection