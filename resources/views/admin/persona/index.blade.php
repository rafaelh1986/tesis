@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Persona</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('persona.create')}}" class="btn btn-sm btn-info btn-block">
            <i class="fas fa-plus"></i>Agregar
        </a>
    </div>
</div>
@endsection
@section('contenido')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <td><b>CI</b></td>
                <td><b>Nombre</b></td>
                <td><b>Apellidos</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($personas as $persona)
            <tr>
                <td>{{$persona->ci}}</td>
                <td>{{$persona->nombres}}</td>
                <td>{{$persona->apellidos}}</td>
                <td>
                    <a href="{{route('persona.show' , $persona->id)}}"
                        class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{route('persona.edit' , $persona->id)}}"
                        class="btn btn-sm btn-info">
                        <i class="fas fa-pen"></i>
                    </a>
                    @php
                    if($persona->estado==0)
                    {
                    $icono_delete="redo";
                    $bg_btn = "warning";
                    }
                    else{
                    $icono_delete="trash";
                    $bg_btn = "danger";
                    }
                    @endphp
                    <a href="{{route('persona.destroy' , $persona->id)}}"
                        class="btn btn-sm btn-{{$bg_btn}}" onclick="return confirm('¿Estas seguro?')">
                        <i class="fas fa-{{$icono_delete}}"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form method="GET" class="form-inline mb-2">
        <label for="per_page" class="mr-2">Mostrar</label>
        <select name="per_page" id="per_page" class="form-control mr-2" onchange="this.form.submit()">
            <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
        </select>
        <span>registros por página</span>
    </form>
</div>
<hr class="sidebar-divider d-none d-sm-block" style color="#b7b9cc">
{{$personas->appends(request()->except('page')) -> links()}}
@endsection