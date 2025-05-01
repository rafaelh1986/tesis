@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Editar equipo</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('equipo.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('equipo.update', $equipo->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            
            <div class="col-md-3">
                <input type="hidden" name="id_tipo_equipo" id="" class="form-control" readonly
                    value="{{$equipo->id_tipo_equipo}}">
                <label for="">Modelo</label>
                <input type="text" name="id_modelo" id="" class="form-control" 
                    value="{{$equipo->modelo->nombre_comercial}}">
            </div>
            <div class="col-md-3">
                <label for="">Marca</label>
                <input type="text" name="id_marca" id="" class="form-control" 
                    value="{{$equipo->marca->nombre}}">
            </div>
            <div class="col-md-3">
                <label for="">Proveedor</label>
                <input type="text" name="id_proveedor" id="" class="form-control" 
                    value="{{$equipo->proveedor->razon_social}}">
            </div>
            <div class="col-md-3">
                <label for="">Garantia</label>
                <input type="text" name="garantia" id="" class="form-control" 
                    value="{{$equipo->garantia}}" required>
            </div>
            <div class="col-md-3">
                <label for="">Cantidad</label>
                <input type="numerico" name="cantidad" id="" class="form-control" 
                    value="{{$equipo->cantidad}}" required>
            </div>
            <div class="col-md-3">
                <label for="">Fecha recepción</label>
                <input type="date" name="fecha_recepcion" id="" class="form-control" 
                    value="{{$equipo->fecha_recepcion}}" readonly>
            </div>
            <div class="col-md-3">
                <label for="">Orden de compra</label>
                <input type="text" name="orden_compra" id="" class="form-control" 
                    value="{{$equipo->orden_compra}}" >
            </div>
        </div>
        <hr>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
    </form>
    
@endsection

