@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Crear Baja inventario</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('bajainventario.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('bajainventario.store')}}" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-3">
                <label for="">Equipo</label>
                <select name="id_inventario" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($inventarios as $inventario)
                        <option value="{{$inventario->id}}">{{$inventario->equipo->modelo->nombre_comercial.
                            " ".$inventario->numero_serie}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Motivo</label>
                <select name="id_motivo_baja" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($motivobajas as $motivobaja)
                        <option value="{{$motivobaja->id}}">{{$motivobaja->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Fecha</label>
                <input type="date" name="fecha" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="">Gestión</label>
                <input type="text" name="gestion" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
@endsection

