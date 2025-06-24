@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Editar modelo</h4>
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
<form action="{{route('modelo.update', $modelo->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-3">
            <label for="id_tipo_equipo">Tipo de equipo</label>
            <select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control" required>
                @foreach($tipo_equipos as $tipo)
                    <option value="{{ $tipo->id }}" {{ $modelo->id_tipo_equipo == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="nombre_comercial">Nombre comercial</label>
            <input type="text" name="nombre_comercial" id="nombre_comercial" class="form-control"
                value="{{$modelo->nombre_comercial}}">
        </div>
        <div class="col-md-3">
            <label for="nombre_tecnico">Nombre técnico</label>
            <input type="text" name="nombre_tecnico" id="nombre_tecnico" class="form-control"
                value="{{$modelo->nombre_tecnico}}">
        </div>
        <div class="col-md-3">
            <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
        </div>
    </div>
</form>
@endsection