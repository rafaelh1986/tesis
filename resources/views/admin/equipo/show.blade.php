@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Equipo</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('equipo.index')}}" class="btn btn-sm btn-info btn-block">
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
                    {{$equipo->id}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Tipo de equipo</b>
                    </td>
                    
                    <td>
                        {{$equipo->modelo->tipo_equipo->nombre}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Modelo</b>
                    </td>
                    <td>
                        {{$equipo->modelo->nombre_comercial}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Marca</b>
                    </td>
                    <td>
                        {{$equipo->marca->nombre}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Proveedor</b>
                    </td>
                    <td>
                        {{$equipo->proveedor->razon_social}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Garantía</b>
                    </td>
                    <td>
                        {{$equipo->garantia}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Cantidad</b>
                    </td>
                    <td>
                        {{$equipo->cantidad}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Fecha de recepción</b>
                    </td>
                    <td>
                        {{$equipo->fecha_recepcion}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Orden de compra</b>
                    </td>
                    <td>
                        {{$equipo->orden_compra}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Estado</b>
                    </td>
                    <td>@if($equipo->estado==0)
                            <label for=""style="color:brown">Inactivo</label>
                        @else
                            <label for="">Activo</label>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-3">
            <a href="{{route('equipo.edit' , $equipo->id)}}" class="btn btn-primary btn-block mt-4">
                Editar                    
            </a>
        </div>
    </div>

@endsection

