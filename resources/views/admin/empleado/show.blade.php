@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">empleado</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('empleado.index')}}" class="btn btn-sm btn-info btn-block">
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
                    {{$empleado->id}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Nombre completo</b>
                    </td>
                    <td>
                        {{$empleado->persona->nombres.' '.$empleado->persona->apellidos}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Área</b>
                    </td>
                    <td>
                        {{$empleado->area->nombre}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Ciudad</b>
                    </td>
                    <td>
                        {{$empleado->ciudad->nombre}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Cargo</b>
                    </td>
                    <td>
                        {{$empleado->cargo->nombre}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Email</b>
                    </td>
                    <td>
                        {{$empleado->email}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Teléfono interno</b>
                    </td>
                    <td>
                        {{$empleado->telefono_interno}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Fecha de ingreso</b>
                    </td>
                    <td>
                        {{$empleado->fecha_ingreso}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Fecha de salida</b>
                    </td>
                    <td>
                        {{$empleado->fecha_salida}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Estado</b>
                    </td>
                    <td>@if($empleado->estado==0)
                            <label for=""style="color:brown">Inactivo</label>
                        @else
                            <label for="">Activo</label>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-3">
            <a href="{{route('empleado.edit' , $empleado->id)}}" class="btn btn-primary btn-block mt-4">
                Editar                    
            </a>
        </div>
    </div>

@endsection

