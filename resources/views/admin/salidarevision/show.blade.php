@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Salida revisión</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('salida_revision.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead>
                
            </thead>
            <tbody>
            <tr>
                    <td>
                        <b>Id</b>
                    </td>
                    <td>
                    {{$salida_revision->id}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Equipo</b>
                    </td>
                    <td>
                        {{$salida_revision->inventario->equipo->modelo->nombre_comercial}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Serie</b>
                    </td>
                    <td>
                        {{$salida_revision->inventario->numero_serie}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Fecha salida</b>
                    </td>
                    <td>
                        {{$salida_revision->fecha_salida}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Descripción</b>
                    </td>
                    <td>
                        {{$salida_revision->descripcion}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Fecha retorno</b>
                    </td>
                    <td>
                        {{$salida_revision->fecha_retorno}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Observaciones</b>
                    </td>
                    <td>
                        {{$salida_revision->observaciones}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>ESTADO</b>
                    </td>
                    <td>@if($salida_revision->estado==0)
                            <label for=""style="color:brown">Inactivo</label>
                        @else
                            <label for="">Activo</label>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-3">
            <a href="{{route('salida_revision.edit' , $salida_revision->id)}}" class="btn btn-primary btn-block mt-4">
                Editar                    
            </a>
        </div>
    </div>

@endsection

