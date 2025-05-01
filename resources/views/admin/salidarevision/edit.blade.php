@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Editar salidarevision</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('salida_revision.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('salida_revision.update', $salida_revision->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-3">
                <label for="">Equipo</label>
                <input type="text" name="" id="" class="form-control" readonly
                    value="{{$salida_revision->inventario->equipo->modelo->nombre_comercial}}">
            </div>
            <div class="col-md-3">
                <label for="">Serie</label>
                <input type="text" name="" id="" class="form-control" readonly
                    value="{{$salida_revision->inventario->numero_serie}}">
            </div>
            <div class="col-md-3">
                <label for="">Proveedor</label>
                <input type="text" name="id_marca" id="" class="form-control" readonly
                    value="{{$salida_revision->proveedor->razon_social}}">
            </div>
            <div class="col-md-3">
                <label for="">Fecha Salida</label>
                <input type="date" name="fecha_salida" id="" class="form-control" 
                    value="{{$salida_revision->fecha_salida}}">
            </div>
            <div class="col-md-3">
                <label for="">Descripción</label>
                <input type="text" name="descripcion" id="" class="form-control" 
                    value="{{$salida_revision->descripcion}}">
            </div>
            <div class="col-md-3">
                <label for="">Fecha retorno</label>
                <input type="date" name="fecha_retorno" id="" class="form-control" 
                    value="{{$salida_revision->fecha_retorno}}" >
            </div>
            <div class="col-md-3">
                <label for="">Observaciones</label>
                <input type="text" name="observaciones" id="" class="form-control" 
                    value="{{$salida_revision->observaciones}}" >
            </div>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
    
@endsection

