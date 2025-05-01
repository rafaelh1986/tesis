@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Crear equipo</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('equipo.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('equipo.store')}}" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-3">
                <label for="">Tipo de equipo</label>
                <select name="id_tipo_equipo" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($tipo_equipos as $tipo_equipo)
                        <option value="{{$tipo_equipo->id}}">{{$tipo_equipo->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Modelo</label>
                <select name="id_modelo" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($modelos as $modelo)
                        <option value="{{$modelo->id}}">{{$modelo->nombre_comercial}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Marca</label>
                <select name="id_marca" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Proveedor</label>
                <select name="id_proveedor" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{$proveedor->id}}">{{$proveedor->razon_social}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Garantia</label>
                <input type="text" name="garantia" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="">Cantidad</label>
                <input type="text" name="cantidad" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="">Fecha recepcion</label>
                <input type="date" name="fecha_recepcion" id="" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="">Orden de compra</label>
                <input type="text" name="orden_compra" id="" class="form-control" required>
            </div>
            
        </div>
        <hr>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
    </form>
@endsection

