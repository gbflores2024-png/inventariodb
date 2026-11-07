@extends('kpis.layout', ['titulo' => 'Operaciones comerciales'])
@section('kpi_content')
@php $tarjetas = [['Pedidos registrados',$kpi['pedidos'],'primary'],['Reservas registradas',$kpi['reservas'],'info'],['Ventas registradas',$kpi['ventas'],'success'],['Devoluciones registradas',$kpi['devoluciones'],'warning']]; @endphp
@include('kpis.tarjetas')
<div class="alert alert-info">Estos indicadores muestran el total de registros de cada operación.</div>
@stop
