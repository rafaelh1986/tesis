<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Asignaciones</title>
    <style>
        body {
            color: #333;
            font-family: 'Arial', sans-serif;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 4px 8px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .logo {
            width: 120px;
        }

        .titulo {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    @php
    $empleados = $detalles->map(function ($detalle) {
    return trim(($detalle->asignacion->empleado->persona->nombres ?? '') . ' ' . ($detalle->asignacion->empleado->persona->apellidos ?? ''));
    })->filter()->unique();
    $empleadoUnico = $empleados->count() === 1 ? $empleados->first() : null;
    @endphp
    <div style="margin-bottom: 24px; display: flex; align-items: flex-start; justify-content: space-between;">
        <img src="{{ public_path('img/logoy.png') }}" alt="Logo" class="logo">
        <div style="text-align: right;">
            <p style="margin: 0;">
                <strong>Generado por:</strong> {{ Auth::user()->persona->nombres.' '.Auth::user()->persona->apellidos }}<br>
                <strong>Fecha y hora:</strong> {{ $fechaHora }}
            </p>
        </div>
    </div>

    <h2 class="titulo">Listado de asignaciones</h2>

    @if($empleadoUnico)
    <div style="margin-bottom: 8px; text-align: left; font-weight: bold;">
        Asignado a: {{ $empleadoUnico }}
    </div>
    @endif
    <br>
    <table>
        <thead>
            <tr>
                @unless($empleadoUnico)
                <th>Empleado</th>
                @endunless
                <th>Tipo de Equipo</th>
                <th>Equipo</th>
                <th>Serie</th>
                <th>Fecha Recepción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalles as $detalle)
            <tr>
                @unless($empleadoUnico)
                <td>
                    {{ $detalle->asignacion->empleado->persona->nombres ?? '-' }}
                    {{ $detalle->asignacion->empleado->persona->apellidos ?? '' }}
                </td>
                @endunless
                <td>{{ $detalle->inventario->equipo->modelo->tipo_equipo->nombre ?? '-' }}</td>
                <td>{{ $detalle->inventario->equipo->modelo->nombre_comercial ?? '-' }}</td>
                <td>{{ $detalle->inventario->numero_serie ?? '-' }}</td>
                <td>{{ $detalle->inventario->equipo->fecha_recepcion ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>