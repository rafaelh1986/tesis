<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota de asignación</title>
    
    <style>
        body{
            color: #333;
            font-family:'Arial';
        }
        th,td{
            border: 1px solid #333;
            padding: 2px 8px;
        }
    </style>
    
</head>
<body>
    <div style="margin-bottom: 24px">
        <label style="text-align:center; width:200px">
            <img src="{{ public_path('img/logoy.png') }}" alt="" style="width:120px;">
        </label>
        
        <label style="float: right; font-size: 12px;" for=""><b>Fecha de asignación: </b>{{$asignacion->fecha_asignacion}}</label>
        <br>
        <label style="float: right; font-size: 12px;" for=""><b>Código: </b>BOL.S5.2.3.FR.03</label>
        <br>
    </div>
    <div style="margin-bottom: 8px">
        <label for=""><b>Asignado a: </b>{{$asignacion->empleado->persona->nombres.' '.$asignacion->empleado->persona->apellidos}}</label>
        <label style="float: right" for=""><b>Nro de Asignación: </b>{{$asignacion->id}}</label>                                            
    </div>
    <div><h2> Asignaciones</h2></div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table style="border: 1px solid #333;
                    border-collapse: collapse; width: 100%">
                <thead>
                    <tr>
                        <th><b>Tipo equipo</b></th>
                        <th><b>Modelo</b></th>
                        <th><b>Serie</b></th>
                        
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($detalleAsignaciones as $detalleAsignacion)
                    <tr>
                        <td>{{$detalleAsignacion->inventario->equipo->modelo->tipo_equipo->nombre}}</td>
                        <td>{{$detalleAsignacion->inventario->equipo->modelo->nombre_comercial}}</td>
                        <td>{{$detalleAsignacion->inventario->numero_serie}}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div style="margin-top:64px;">
        <div class="col-md-2" style="display:inline-block; "></div>
        <div class="col-md-3" style="display:inline-block; margin-left:25%; width:20%; text-align: center; border-top:1px solid #444"><b>Entregado por: </b> 
        <br>
        {{ Auth::user()->persona->nombres.' '.Auth::user()->persona->apellidos}}
        </div>
        <div class="col-md-2" style="display:inline-block; "></div>
        <div class="col-md-3" style="display:inline-block; margin-left:20%; width:20%; text-align: center; border-top:1px solid #444">
            <b>Recibido por: </b><br>
            {{$asignacion->empleado->persona->nombres.' '.$asignacion->empleado->persona->apellidos}}
            
        </div>
        <div class="col-md-2" style="display:inline-block; "></div>
    </div>
</body>
</html>