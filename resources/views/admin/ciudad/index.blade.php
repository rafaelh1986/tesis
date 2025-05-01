@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Ciudad</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('ciudad.create')}}" class="btn btn-sm btn-info btn-block">
                                <i class="fas fa-plus"></i>Agregar
        </a>
    </div>
</div>
@endsection
@section('contenido')
<div class="table-responsive">
    <table class="table table-striped" >
        <thead>
            <tr>
                <td><b>Id</b></td>
                <td><b>Descripción</b></td>
                <td><b>Estado</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($ciudades as $ciudad)
                <tr>
                    <td>{{$ciudad->id}}</td>
                    <td>{{$ciudad->nombre}}</td>
                    <td>@if($ciudad->estado==0)
                            <label for=""style="color:brown">Inactivo</label>
                        @else
                            <label for="">Activo</label>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('ciudad.show' , $ciudad->id)}}"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{route('ciudad.edit' , $ciudad->id)}}"
                            class="btn btn-sm btn-info">
                            <i class="fas fa-pen"></i>
                        </a>
                        @php
                            if($ciudad->estado==0)
                            {
                                $icono_delete="redo";
                                $bg_btn = "warning";
                            }
                            else{
                                $icono_delete="trash";
                                $bg_btn = "danger";
                            }
                        @endphp
                        <a href="{{route('ciudad.destroy' , $ciudad->id)}}"
                            class="btn btn-sm btn-{{$bg_btn}}" onclick="return confirm('¿Estas seguro?')">
                            <i class="fas fa-{{$icono_delete}}"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<hr class="sidebar-divider d-none d-sm-block" style color="#b7b9cc">
{{$ciudades -> links()}}
@endsection

