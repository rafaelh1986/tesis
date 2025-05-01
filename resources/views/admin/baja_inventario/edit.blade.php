@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Editar baja inventario</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('bajainventario.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('bajainventario.update', $bajainventario->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-3">
                <label for="">Equipo</label>
                <input type="text" name="" id="" class="form-control" readonly
                    value="{{$bajainventario->inventario->equipo->modelo->nombre_comercial}}">
            </div>
            <div class="col-md-3">
                <label for="">Serie</label>
                <input type="text" name="" id="" class="form-control"
                    value="{{$bajainventario->inventario->numero_serie}}" readonly>
            </div>
            <div class="col-md-3">
                <label for="">Fecha</label>
                <input type="date" name="fecha" id="" class="form-control"
                    value="{{$bajainventario->fecha}}" >
            </div>
            <div class="col-md-3">
                <label for="">Gestión</label>
                <input type="number" name="gestion" id="" class="form-control"
                    value="{{$bajainventario->gestion}}" >
            </div>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
@endsection

