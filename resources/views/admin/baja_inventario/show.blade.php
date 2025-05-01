@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Baja Inventario</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('bajainventario.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                
            </thead>
            <tbody>
            <tr>
                    <td>
                        <b>Id</b>
                    </td>
                    <td>
                    {{$bajainventario->id}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Marca</b>
                    </td>
                    <td>
                        {{$bajainventario->inventario->equipo->marca->nombre}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Modelo</b>
                    </td>
                    <td>
                        {{$bajainventario->inventario->equipo->modelo->nombre_comercial}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Motivo Baja</b>
                    </td>
                    <td>
                        {{$bajainventario->motivo_baja->nombre}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Fecha de Baja</b>
                    </td>
                    <td>
                        {{$bajainventario->fecha}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Gestión</b>
                    </td>
                    <td>
                        {{$bajainventario->gestion}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>ESTADO</b>
                    </td>
                    <td>@if($bajainventario->estado==0)
                            <label for=""style="color:brown">Inactivo</label>
                        @else
                            <label for="">Activo</label>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-3">
            <a href="{{route('bajainventario.edit' , $bajainventario->id)}}" class="btn btn-primary btn-block mt-4">
                Editar                    
            </a>
        </div>
    </div>

@endsection

