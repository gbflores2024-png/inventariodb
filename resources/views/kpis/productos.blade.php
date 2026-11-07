@extends('kpis.layout', ['titulo' => 'Estadísticas de productos'])
@section('kpi_content')
@php $tarjetas = [['Productos registrados',$kpi['productos'],'info']]; @endphp
@include('kpis.tarjetas')
<div class="card"><div class="card-header"><h3 class="card-title">Productos más vendidos (por unidades)</h3></div><div class="card-body table-responsive"><table class="table table-striped"><thead><tr><th>Producto</th><th>Unidades vendidas</th><th>Importe (Bs)</th></tr></thead><tbody>
@forelse($masVendidos as $producto)<tr><td>{{ $producto->nombre }}</td><td>{{ $producto->unidades }}</td><td>{{ number_format($producto->importe,2,',','.') }}</td></tr>@empty<tr><td colspan="3">Todavía no existen detalles de ventas.</td></tr>@endforelse
</tbody></table></div></div>
@stop
