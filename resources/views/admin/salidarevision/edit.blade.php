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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{route('salida_revision.update', $salida_revision->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-3">
                <label for="equipo">Equipo</label>
                <input type="text" name="" id="equipo" class="form-control" readonly
                    value="{{$salida_revision->inventario->equipo->modelo->nombre_comercial}}">
            </div>
            <div class="col-md-3">
                <label for="serie">Serie</label>
                <input type="text" name="" id="serie" class="form-control" readonly
                    value="{{$salida_revision->inventario->numero_serie}}">
            </div>
            <div class="col-md-3">
                <label for="proveedor">Proveedor</label>
                <input type="text" name="id_proveedor" id="proveedor" class="form-control" readonly
                    value="{{$salida_revision->proveedor->razon_social}}">
            </div>
            <div class="col-md-3">
                <label for="fecha_salida">Fecha Salida</label>
                <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" 
                    value="{{$salida_revision->fecha_salida}}">
            </div>
            <div class="col-md-3">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" 
                    value="{{$salida_revision->descripcion}}">
            </div>
            <div class="col-md-3">
                <label for="fecha_retorno">Fecha retorno</label>
                <input type="date" name="fecha_retorno" id="fecha_retorno" class="form-control" 
                    value="{{$salida_revision->fecha_retorno}}" >
            </div>
            <div class="col-md-3">
                <label for="observaciones">Observaciones</label>
                <input type="text" name="observaciones" id="observaciones" class="form-control" 
                    value="{{$salida_revision->observaciones}}" >
            </div>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
    
@endsection

