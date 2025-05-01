@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Editar persona</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('persona.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('persona.update', $persona->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-3">
                <label for="">Ci</label>
                <input type="" name="ci" id="" class="form-control" 
                    value="{{$persona->ci}}" required>
            </div>
            <div class="col-md-3">
                <label for="">Nombres</label>
                <input type="text" name="nombres" id="" class="form-control" 
                    value="{{$persona->nombres}}">
            </div>
            <div class="col-md-3">
                <label for="">Apellidos</label>
                <input type="text" name="apellidos" id="" class="form-control" 
                    value="{{$persona->apellidos}}">
            </div>
            
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
@endsection

