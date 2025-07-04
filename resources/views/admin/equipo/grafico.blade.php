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
<style>
    #piechart_3d {
        width: 100%;
        min-width: 300px;
        height: 50vw;
        max-height: 500px;
        margin: auto;
    }
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);

    var chart, data, options;
    function drawChart() {
        var coleccion = {!! json_encode(array_merge([['Modelo', 'Cantidad']], $datos)) !!};
        data = google.visualization.arrayToDataTable(coleccion);

        options = {
            title: 'Cantidad de modelos de Laptops',
            is3D: true,
            chartArea: { width: '90%', height: '80%' }
        };

        chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }

    window.addEventListener('resize', drawChart);
</script>
@else
<div class="alert alert-warning">No hay datos para mostrar el gráfico.</div>
@endif
@endsection
@section('contenido')
<h1>Equipos</h1>
<div id="piechart_3d"></div>
@endsection