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
                <label for="">Modelo</label>
                <select name="id_modelo" class="form-control" required>
                    @foreach($modelos as $modelo)
                        <option value="{{$modelo->id}}" {{$equipo->id_modelo == $modelo->id ? 'selected' : ''}}>{{$modelo->nombre_comercial}}</option>
                    @endforeach 
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Marca</label>
                <select name="id_marca" class="form-control" required>
                    @foreach($marcas as $marca)
                        <option value="{{$marca->id}}" {{$equipo->id_marca == $marca->id ? 'selected' : ''}}>{{$marca->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Proveedor</label>
                <select name="id_proveedor" class="form-control" required>
                    @foreach($proveedores as $proveedor)
                        <option value="{{$proveedor->id}}" {{$equipo->id_proveedor == $proveedor->id ? 'selected' : ''}}>{{$proveedor->razon_social}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Garantia</label>
                <input type="text" name="garantia" id="" class="form-control" 
                    value="{{$equipo->garantia}}" required>
            </div>
            <div class="col-md-3">
                <label for="">Cantidad</label>
                <input type="number" name="cantidad" id="" class="form-control" 
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

