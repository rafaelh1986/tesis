@extends('template.index')
@section('encabezado')
@php
$asignacionBloqueada = $asignacion->estado != 1;
@endphp
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
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
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
<form id="form-agregar-equipo" onsubmit="return false;">
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
        <div class="col-md-2">
            <button type="button" id="btn-agregar" class="btn btn-sm btn-primary" disabled
                @if($asignacionBloqueada) disabled @endif>
                <i class="fas fa-plus"></i> Agregar
            </button>
        </div>
    </div>
</form>
<table class="table table-striped mt-4" id="tabla-temporal" style="display:none;">
    <thead>
        <tr>
            <th>Equipo</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <!-- Aquí se agregan los equipos temporalmente -->
    </tbody>
</table>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Equipo</th>
                    <th>Serie</th>
                    <th>Cod A.F.</th>
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
                        {{
                                $detalleAsignacion->inventario ? $detalleAsignacion->inventario-> codigo_activo_fijo: '-' 
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
<form id="form-guardar-temporal" action="{{ route('asignacion.storeDetalle') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="id_asignacion" value="{{ $asignacion->id }}">
    <div id="inputs-equipos"></div>
    <button type="submit" class="btn btn-success" id="btn-guardar" disabled @if($asignacionBloqueada) disabled @endif>
        <i class="fas fa-save"></i> Guardar
    </button>
    <button type="button" class="btn btn-danger" id="btn-cancelar" @if($asignacionBloqueada) disabled @endif>
        <i class="fas fa-ban"></i> Cancelar
    </button>
</form>
<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-2">
        <a href="{{ route('asignacion.cancelar', $asignacion->id) }}"
            class="btn btn-danger"
            id="btn-quitar-todo"
            onclick="return confirmarQuitarTodo();"
            @if($asignacionBloqueada) disabled @endif>
            Quitar todo
        </a>
    </div>
    <div class="col-md-2">
        <form action="{{route('asignacion.update', $asignacion->id)}}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$asignacion->id}}">
            <button type="submit" class="btn btn-block btn-success" @if($asignacionBloqueada) disabled @endif>
                <i class="fas fa-save"></i> Confirmar
            </button>
        </form>
    </div>
</div>
<script>
    const asignacionBloqueada = {{ $asignacionBloqueada ? 'true' : 'false' }};
    // Habilita el botón solo si hay equipo seleccionado
    document.getElementById('id_inventario').addEventListener('change', function() {
        const btnAgregar = document.getElementById('btn-agregar');
        if (asignacionBloqueada) {
            btnAgregar.disabled = true;
        } else {
            btnAgregar.disabled = !this.value;
        }
    });

    let equiposTemporales = [];

    document.getElementById('btn-agregar').addEventListener('click', function() {
        if (asignacionBloqueada) return;
        const select = document.getElementById('id_inventario');
        const id = select.value;
        const text = select.options[select.selectedIndex].text;

        if (!id || equiposTemporales.find(e => e.id == id)) return;

        equiposTemporales.push({
            id,
            text
        });
        renderTablaTemporal();

        // Mostrar tabla y form temporal
        document.getElementById('tabla-temporal').style.display = '';
        document.getElementById('form-guardar-temporal').style.display = '';
        document.getElementById('btn-guardar').disabled = false;
    });

    function renderTablaTemporal() {
        const tbody = document.querySelector('#tabla-temporal tbody');
        tbody.innerHTML = '';
        equiposTemporales.forEach((equipo, idx) => {
            tbody.innerHTML += `
            <tr>
                <td>${equipo.text}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="quitarEquipo(${idx})">Quitar</button>
                </td>
            </tr>
        `;
        });

        // Actualiza los inputs ocultos para el form de guardar
        const inputsDiv = document.getElementById('inputs-equipos');
        inputsDiv.innerHTML = '';
        equiposTemporales.forEach(equipo => {
            inputsDiv.innerHTML += `<input type="hidden" name="id_inventario[]" value="${equipo.id}">`;
        });
    }

    window.quitarEquipo = function(idx) {
        equiposTemporales.splice(idx, 1);
        renderTablaTemporal();
        if (equiposTemporales.length === 0) {
            document.getElementById('tabla-temporal').style.display = 'none';
            document.getElementById('form-guardar-temporal').style.display = 'none';
            document.getElementById('btn-guardar').disabled = true;
        }
    }

    // Botón cancelar: limpia la tabla temporal y oculta tabla y form temporal
    document.getElementById('btn-cancelar').addEventListener('click', function() {
        equiposTemporales = [];
        renderTablaTemporal();
        document.getElementById('tabla-temporal').style.display = 'none';
        document.getElementById('form-guardar-temporal').style.display = 'none';
        document.getElementById('btn-guardar').disabled = true;
    });

    // Al guardar, oculta tabla y form temporal
    document.getElementById('form-guardar-temporal').addEventListener('submit', function() {
        document.getElementById('tabla-temporal').style.display = 'none';
        document.getElementById('form-guardar-temporal').style.display = 'none';
        document.getElementById('btn-agregar').disabled = true;
        document.querySelector('button[type="submit"].btn-success').disabled = true;
        document.getElementById('btn-cancelar').disabled = true;
    });

    // Al confirmar, deshabilita "Agregar" y "Confirmar"
    document.querySelector('form[action*="asignacion.update"]').addEventListener('submit', function(e) {
        if (asignacionBloqueada) {
            e.preventDefault();
            return false;
        }
        document.getElementById('btn-agregar').disabled = true;
        this.querySelector('button[type="submit"]').disabled = true;
    });

    function confirmarQuitarTodo() {
        return confirm('¡Advertencia!\n\nEsta acción eliminará TODAS las asignaciones de este usuario.\n¿Desea continuar?');
    }
</script>
@endsection