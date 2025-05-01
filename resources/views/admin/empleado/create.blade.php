@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Crear empleado</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('empleado.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <form action="{{route('empleado.store')}}" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-3">
                <label for="">Persona</label>
                <select name="id_persona" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($personas as $persona)
                        <option value="{{$persona->id}}">{{$persona->nombres.' '.$persona->apellidos}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Area</label>
                <select name="id_area" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($areas as $area)
                        <option value="{{$area->id}}">{{$area->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Ciudad</label>
                <select name="id_ciudad" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($ciudades as $ciudad)
                        <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Cargo</label>
                <select name="id_cargo" id=""class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($cargos as $cargo)
                        <option value="{{$cargo->id}}">{{$cargo->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">email</label>
                <input type="email" name="email" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="">Teléfono</label>
                <input type="text" name="telefono_interno" id="" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="">Fecha ingreso</label>
                <input type="date" name="fecha_ingreso" id="" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="">Fecha salida</label>
                <input type="date" name="fecha_salida" id="" class="form-control">
            </div>
            <div class="col-md-3">
                <input type="submit" value="Guardar" class="btn btn-success btn-block mt-4">
            </div>
        </div>
    </form>
@endsection

