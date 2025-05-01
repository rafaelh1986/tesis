@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Crear asignacion</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('asignacion.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('asignacion.store')}}" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-3">
                <label for="">asignar a:</label>
                <select name="id_empleado" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($empleados as $empleado)
                        <option value="{{$empleado->id}}">{{$empleado->persona->nombres}} {{$empleado->persona->apellidos}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Fecha de asignación</label>
                <input type="date" name="fecha_asignacion" id="" class="form-control">
            </div>
            
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
@endsection

