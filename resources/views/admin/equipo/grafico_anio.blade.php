@extends('template.index')
@section('encabezado')
<div class="row">
    <div class="col-md-9">
        <h4 class="m-0 font-weight-bold text-primary">Equipos adquiridos por año</h4>
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
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var coleccion = {!! json_encode(array_merge([['Año', 'Cantidad', ['role' => 'style']]], $datos)) !!};
        coleccion[0][2] = { role: 'style' }; // Corrige el encabezado

        var data = google.visualization.arrayToDataTable(coleccion);

        var options = {
            title: 'Equipos adquiridos por año',
            chartArea: { width: '90%', height: '80%' },
            legend: 'none'
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_anio'));
        chart.draw(data, options);
    }
    window.addEventListener('resize', drawChart);
</script>
@endif
@endsection
@section('contenido')
<form method="GET" class="mb-3">
    <label for="anio">Filtrar por año:</label>
    <select name="anio" id="anio" onchange="this.form.submit()">
        <option value="">-- Todos --</option>
        @foreach($anios as $anio)
        <option value="{{ $anio }}" {{ $anioSeleccionado == $anio ? 'selected' : '' }}>{{ $anio }}</option>
        @endforeach
    </select>
</form>
<div id="columnchart_anio" style="width: 100%; min-width: 300px; height: 400px;"></div>
@endsection