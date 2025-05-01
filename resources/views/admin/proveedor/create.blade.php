@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Crear Persona</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('proveedor.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('proveedor.store')}}" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-3">
                <label for="">Razón social</label>
                <input type="text" name="razon_social" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="">NIT</label>
                <input type="text" name="nit" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="">Teléfono</label>
                <input type="text" name="telefono" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="">Email</label>
                <input type="email" name="email" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
@endsection

