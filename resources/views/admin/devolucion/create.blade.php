@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Registrar devolución de equipo</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('devolucion.index')}}" class="btn btn-sm btn-info btn-block">
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
<form action="{{route('devolucion.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-6">
            <label for="id_detalle_asignacion">Asignación a devolver</label>
            <select name="id_detalle_asignacion" id="id_detalle_asignacion" class="form-control" required>
                <option value="">-- Seleccionar --</option>
                @foreach($detalles_asignacion as $detalle)
                <option value="{{$detalle->id}}">
                    {{$detalle->asignacion->empleado->persona->nombres}} {{$detalle->asignacion->empleado->persona->apellidos}} - 
                    {{$detalle->inventario->equipo->modelo->nombre_comercial}} {{$detalle->inventario->numero_serie}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="id_motivo_devolucion">Motivo de devolución</label>
            <select name="id_motivo_devolucion" id="id_motivo_devolucion" class="form-control" required>
                <option value="">-- Seleccionar --</option>
                @foreach($motivo_devolucion as $motivo)
                <option value="{{$motivo->id}}">{{$motivo->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="fecha_devolucion">Fecha de devolución</label>
            <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="form-control" value="{{ old('fecha_devolucion') }}" required>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="4">{{ old('observaciones') }}</textarea>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2">
            <input type="submit" value="Guardar" class="btn btn-success btn-block">
        </div>
    </div>
</form>
@endsection
