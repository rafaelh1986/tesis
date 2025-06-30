@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Area</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('area.index')}}" class="btn btn-sm btn-info btn-block">
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
                    {{$area->id}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Descripción</b>
                    </td>
                    <td>
                        {{$area->nombre}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Estado</b>
                    </td>
                    <td>@if($area->estado==0)
                            <label for="estado"style="color:brown">Inactivo</label>
                        @else
                            <label for="estado">Activo</label>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-3">
            <a href="{{route('area.edit' , $area->id)}}" class="btn btn-primary btn-block mt-4">
                Editar                    
            </a>
        </div>
    </div>

@endsection

