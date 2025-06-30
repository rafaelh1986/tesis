@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Gráfico</h4>
    </div>
    <div class="col-md-3">
        <a href="{{route('equipo.index')}}" class="btn btn-sm btn-info btn-block">
            <i class="fas fa-arrow-left"></i>Volver
        </a>
    </div>
</div>
@endsection
@section('head')
@if(count($datos))
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var coleccion = {!! json_encode(array_merge([['Modelo', 'Cantidad']], $datos)) !!};
        var data = google.visualization.arrayToDataTable(coleccion);

        var options = {
            title: 'Cantidad de modelos de Laptops',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>
@else
<div class="alert alert-warning">No hay datos para mostrar el gráfico.</div>
@endif
@endsection
@section('contenido')
<h1>Equipos</h1>
<div id="piechart_3d" style="width: 900px; height: 500px;"></div>

@endsection