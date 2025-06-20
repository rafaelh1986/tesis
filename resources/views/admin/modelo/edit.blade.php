@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Editar cargo</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('modelo.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('modelo.update', $modelo->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-3">
                <input type="hidden" name="id_tipo_equipo" id="" class="form-control" readonly
                    value="{{$modelo->id_tipo_equipo}}">
                <label for="">Modelo</label>
                <input type="text" name="id_modelo" id="" class="form-control" 
                    value="{{$modelo->nombre_comercial}}">
            </div>
            <div class="col-md-3">
                <label for="">Nombre comercial</label>
                <input type="text" name="nombre_comercial" id="" class="form-control"
                    value="{{$modelo->nombre_comercial}}">
            </div>
            <div class="col-md-3">
                <label for="">Nombre técnico</label>
                <input type="text" name="nombre_tecnico" id="" class="form-control"
                    value="{{$modelo->nombre_tecnico}}">
            </div>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
@endsection

