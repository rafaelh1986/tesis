@extends('template.index')
@section('encabezado')
    <div class="row">
        <div class="col-md-9">
            <h4 class="m-0 font-weight-bold text-primary">Editar asignación</h4>
        </div>
        <div class="col-md-3">
            <a href="{{route('asignacion.index')}}" class="btn btn-sm btn-info btn-block">
                                    <i class="fas fa-arrow-left"></i>Volver
            </a>
        </div>
    </div>
@endsection
@section('contenido')
    
        <div class="row">
            <div class="col-md-3">
                <label for=""><b>Asignado a:</b></label>
                <label for="">
                    {{$asignacion->empleado->persona->nombres.' '.$asignacion->empleado->persona->apellidos}}
                </label>
                
            </div>
            <div class="col-md-6">

            </div>
            <div class="col-md-3">
                <label for=""><b>N° Asignación:</b></label>
                <label for="">{{$asignacion->id}}</label>
            </div>
        </div>
    
    
    <hr>
    <form action="{{route('asignacion.storeDetalle')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-1">
                <label for="">Equipo</label>
            </div>
            <div class="col-md-3">
                <select name="id_inventario" id="id_inventario" class="form-control">
                <option value="">Seleccionar</option>
                @foreach($inventarios as $inventario)
                    <option value="{{$inventario->id}}">
                        {{
                            $inventario->equipo && $inventario->equipo->modelo 
                            && $inventario->equipo->modelo->tipo_equipo
                                ? $inventario->equipo->modelo->tipo_equipo->nombre.',
                                 '.$inventario->equipo->modelo->nombre_comercial.', S/N:'.$inventario->numero_serie
                                : 'Equipo incompleto (ID: '.$inventario->id.')'
                        }}
                    </option>
                @endforeach
            </select>
            </div>
            <div class="col-md-1">
            <input type="hidden" name="id_asignacion" value="{{$asignacion->id}}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus">Agregar</i>
                </button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Equipo</th>
                        <th>Serie</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalleAsignaciones as $detalleAsignacion)
                    <tr>
                        <td>
                            {{
                                $detalleAsignacion->inventario
                                && $detalleAsignacion->inventario->equipo
                                && $detalleAsignacion->inventario->equipo->modelo
                                && $detalleAsignacion->inventario->equipo->modelo->tipo_equipo
                                ? $detalleAsignacion->inventario->equipo->modelo->tipo_equipo->nombre
                                : '-'
                            }}
                        </td>
                        <td>
                            {{
                                $detalleAsignacion->inventario
                                && $detalleAsignacion->inventario->equipo
                                && $detalleAsignacion->inventario->equipo->modelo
                                ? $detalleAsignacion->inventario->equipo->modelo->nombre_comercial
                                : '-'
                            }}
                        </td>
                        <td>
                            {{ 
                                $detalleAsignacion->inventario ? $detalleAsignacion->inventario->numero_serie : '-' 
                            }}
                        </td>
                        <td>
                            <a href="{{route('asignacion.destroyDetalle', $detalleAsignacion->id)}}"
                                    class="btn btn-sm btn-danger" onclick="return confirm('¿Estas seguro?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-2">
            <a href="{{route('asignacion.cancelar',$asignacion->id)}}"class="btn btn-block btn-danger">
                <i class="fas fa-ban"> </i> Cancelar
            </a>
        </div>
        <div class="col-md-2">
            <form action="{{route('asignacion.update', $asignacion->id)}}" method="post">
            @csrf
            @method('PUT')
                <input type="hidden" name="id" value="{{$asignacion->id}}">
                <button type="submit"class="btn btn-block btn-success">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </form>
        </div>
    </div>
    
@endsection

