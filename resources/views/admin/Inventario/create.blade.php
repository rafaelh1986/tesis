@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Crear inventario</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('inventario.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('inventario.store')}}" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-3">
                <label for="">Equipo</label>
                <select name="id_equipo" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($equipos as $equipo)
                        <option value="{{$equipo->id}}">{{$equipo->modelo->nombre_comercial}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Número de Serie</label>
                <input type="text" name="numero_serie" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="">Código de AF</label>
                <input type="text" name="codigo_activo_fijo" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
@endsection

