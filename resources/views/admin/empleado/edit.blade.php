@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Editar empleado</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('empleado.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('empleado.update', $empleado->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-3">
                <label for="">Empleado</label>
                <input type="text" name="" id="" class="form-control" readonly
                    value="{{$empleado->persona->nombres.' '.$empleado->persona->apellidos}}">
            </div>
            <div class="col-md-3">
                <label for="">Area</label>
                <input type="text" name="id_area" id="" class="form-control" 
                    value="{{$empleado->area->nombre}}">
            </div>
            <div class="col-md-3">
                <label for="">Ciudad</label>
                <input type="text" name="id_ciudad" id="" class="form-control" 
                    value="{{$empleado->ciudad->nombre}}">
            </div>
            <div class="col-md-3">
                <label for="">Cargo</label>
                <input type="text" name="id_cargo" id="" class="form-control" 
                    value="{{$empleado->cargo->nombre}}">
            </div>
            <div class="col-md-3">
                <label for="">Email</label>
                <input type="email" name="email" id="" class="form-control" 
                    value="{{$empleado->email}}" required>
            </div>
            <div class="col-md-3">
                <label for="">Interno</label>
                <input type="text" name="telefono_interno" id="" class="form-control" 
                    value="{{$empleado->telefono_interno}}" required>
            </div>
            <div class="col-md-3">
                <label for="">Fecha ingreso</label>
                <input type="date" name="fecha_ingreso" id="" class="form-control" 
                    value="{{$empleado->fecha_ingreso}}" readonly>
            </div>
            <div class="col-md-3">
                <label for="">fecha salida</label>
                <input type="date" name="fecha_salida" id="" class="form-control" 
                    value="{{$empleado->fecha_salida}}" >
            </div>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
    
@endsection

