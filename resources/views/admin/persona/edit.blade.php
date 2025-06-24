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
                <label for="ci">Ci</label>
                <input type="text" name="ci" id="ci" class="form-control" 
                    value="{{$persona->ci}}" readonly >
            </div>
            <div class="col-md-3">
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres" id="nombres" class="form-control" 
                    value="{{$persona->nombres}}">
            </div>
            <div class="col-md-3">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" class="form-control" 
                    value="{{$persona->apellidos}}">
            </div>
            
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
@endsection

