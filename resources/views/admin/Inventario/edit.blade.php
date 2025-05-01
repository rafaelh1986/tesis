@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Editar inventario</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('inventario.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('inventario.update', $inventario->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-3">
                <label for="">Equipo</label>
                <input type="text" name="" id="" class="form-control" readonly
                    value="{{$inventario->equipo->Modelo->nombre_comercial}}">
            </div>
            <div class="col-md-3">
                <label for="">Número de serie</label>
                <input type="text" name="numero_serie" id="" class="form-control" 
                    value="{{$inventario->numero_serie}}">
            </div>
            <div class="col-md-3">
                <label for="">Código AF</label>
                <input type="text" name="codigo_activo_fijo" id="" class="form-control" 
                    value="{{$inventario->codigo_activo_fijo}}">
            </div>
            
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
    
@endsection

