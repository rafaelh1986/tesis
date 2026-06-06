@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Ver devolución</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('devolucion.index')}}" class="btn btn-sm btn-info btn-block">
            <i class="fas fa-arrow-left"></i>Volver
        </a>
    </div>
</div>
@endsection
@section('contenido')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6><b>ID:</b> {{$devolucion->id}}</h6>
                <h6><b>Empleado:</b> {{$devolucion->detalleAsignacion->asignacion->empleado->persona->nombres}} {{$devolucion->detalleAsignacion->asignacion->empleado->persona->apellidos}}</h6>
                <h6><b>Equipo:</b> {{$devolucion->detalleAsignacion->inventario->equipo->nombre}}</h6>
                <h6><b>Motivo:</b> {{$devolucion->motivo->nombre}}</h6>
            </div>
            <div class="col-md-6">
                <h6><b>Fecha de devolución:</b> {{$devolucion->fecha_devolucion}}</h6>
                <h6><b>Registrado por:</b> {{$devolucion->usuario->name}}</h6>
                <h6><b>Estado:</b> @if($devolucion->estado==0)
                    <span style="color:brown">Inactivo</span>
                    @else
                    <span>Activo</span>
                    @endif
                </h6>
                <h6><b>Creado:</b> {{$devolucion->created_at}}</h6>
            </div>
        </div>
        @if($devolucion->observaciones)
        <div class="row mt-3">
            <div class="col-md-12">
                <h6><b>Observaciones:</b></h6>
                <p>{{$devolucion->observaciones}}</p>
            </div>
        </div>
        @endif
        <div class="row mt-3">
            <div class="col-md-2">
                <a href="{{route('devolucion.edit', $devolucion->id)}}" class="btn btn-info btn-block">
                    <i class="fas fa-pen"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
