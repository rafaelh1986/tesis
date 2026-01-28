@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Ver motivo de devolución</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('motivo_devolucion.index')}}" class="btn btn-sm btn-info btn-block">
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
                <h6><b>ID:</b> {{$motivo_devolucion->id}}</h6>
                <h6><b>Nombre:</b> {{$motivo_devolucion->nombre}}</h6>
                <h6><b>Descripción:</b> {{$motivo_devolucion->descripcion}}</h6>
                <h6><b>Estado:</b> @if($motivo_devolucion->estado==0)
                    <span style="color:brown">Inactivo</span>
                    @else
                    <span>Activo</span>
                    @endif
                </h6>
                <h6><b>Creado:</b> {{$motivo_devolucion->created_at}}</h6>
                <h6><b>Actualizado:</b> {{$motivo_devolucion->updated_at}}</h6>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-2">
                <a href="{{route('motivo_devolucion.edit', $motivo_devolucion->id)}}" class="btn btn-info btn-block">
                    <i class="fas fa-pen"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
