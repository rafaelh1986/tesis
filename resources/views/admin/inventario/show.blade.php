@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">inventario</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('inventario.index')}}" class="btn btn-sm btn-info btn-block">
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
                    {{$inventario->id}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Equipo</b>
                    </td>
                    <td>
                        {{$inventario->equipo->modelo->nombre_comercial}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Número de serie</b>
                    </td>
                    <td>
                        {{$inventario->numero_serie}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Código AF</b>
                    </td>
                    <td>
                        {{$inventario->codigo_activo_fijo}}
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <b>Estado</b>
                    </td>
                    <td>
                        @if($inventario->estado==2)
                            <label style="color:blue">Asignado</label>
                        @elseif($inventario->estado==1)
                            <label style="color:green">Disponible</label>
                        @elseif($inventario->estado==3)
                            <label style="color:orange">No disponible</label>
                        @else
                            <label style="color:red">Baja</label>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-3">
            <a href="{{route('inventario.edit' , $inventario->id)}}" class="btn btn-primary btn-block mt-4">
                Editar                    
            </a>
        </div>
    </div>

@endsection

