@extends('adminlte::page')
@section('title', $titulo . ' | KPIs ZARA')
@section('content_header')
<h1><i class="fas fa-chart-line mr-2"></i>{{ $titulo }}</h1>
@stop
@section('content')
<div class="mb-3">
    <a class="btn btn-sm btn-outline-primary" href="{{ route('kpis.resumen') }}">Resumen</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('kpis.ventas') }}">Ventas</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('kpis.productos') }}">Productos</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('kpis.inventario') }}">Inventario</a>
    <a class="btn btn-sm btn-outline-primary" href="{{ route('kpis.operaciones') }}">Operaciones</a>
</div>
@yield('kpi_content')
@stop
