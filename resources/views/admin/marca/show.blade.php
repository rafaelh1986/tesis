@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Marca</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('marca.index')}}" class="btn btn-sm btn-info btn-block">
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
                        <b>Id</b>
                    </td>
                    <td>
                    {{$marca->id}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Descripción</b>
                    </td>
                    <td>
                        {{$marca->nombre}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Estado</b>
                    </td>
                    <td>@if($marca->estado==0)
                            <label for=""style="color:brown">Inactivo</label>
                        @else
                            <label for="">Activo</label>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-3">
            <a href="{{route('marca.edit' , $marca->id)}}" class="btn btn-primary btn-block mt-4">
                Editar                    
            </a>
        </div>
    </div>

@endsection

