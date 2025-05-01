@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Modelo</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('modelo.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    <div class="table-responsive">
        <table class="table table-striped" >
            <thead>
                
            </thead>
            <tbody>
            <tr>
            <tr>
                    <td>
                        <b>Nombre Comercial</b>
                    </td>
                    <td>
                    {{$modelo->nombre_comercial}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Nombre tecnico</b>
                    </td>
                    <td>
                        {{$modelo->nombre_tecnico}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Estado</b>
                    </td>
                    <td>@if($modelo->estado==0)
                            <label for=""style="color:brown">Inactivo</label>
                        @else
                            <label for="">Activo</label>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-3">
            <a href="{{route('modelo.edit' , $modelo->id)}}" class="btn btn-primary btn-block mt-4">
                Editar                    
            </a>
        </div>
    </div>

@endsection

