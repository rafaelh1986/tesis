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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var coleccion = [['Modelo', 'Cantidad']]
        @foreach($datos as $dato)
            var item = ['{{$dato[0]}}',{{$dato[1]}}];
            coleccion.push(item);
        @endforeach
        var data = google.visualization.arrayToDataTable( coleccion);

        var options = {
          title: 'Cantidad de modelos de Laptops',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
@endsection
@section('contenido')
<h1>Equipos</h1>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  
@endsection

