@extends('template.index')
@section('contenido')
    <h3>Bienvenido, {{ Auth::user()->persona->nombres.' '.Auth::user()->persona->apellidos}} </h3>
    <hr>
    <img src="{{asset('img/cdyanbal.jpeg')}}" alt="" srcset="" width="100%" height="100%" >
@endsection