@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Crear Salida Revisión</h4>
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
    <form action="{{route('salida_revision.store')}}" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-3">
                <label for="id_inventario">Número de Serie</label>
                <select name="id_inventario" id="id_inventario" class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($inventarios as $inventario)
                        <option value="{{$inventario->id}}">{{$inventario->equipo->modelo->nombre_comercial.
                            ' | '.$inventario->numero_serie}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="id_proveedor">Proveedor</label>
                <select name="id_proveedor" id="id_proveedor" class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{$proveedor->id}}">{{$proveedor->razon_social}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="fecha_salida">Fecha de salida</label>
                <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="fecha_retorno">Fecha de retorno</label>
                <input type="date" name="fecha_retorno" id="fecha_retorno" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="observaciones">Observaciones</label>
                <input type="text" name="observaciones" id="observaciones" class="form-control">
            </div>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
@endsection

