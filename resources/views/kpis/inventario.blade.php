@extends('kpis.layout', ['titulo' => 'Estadísticas de inventario'])
@section('kpi_content')
@php $tarjetas = [['Stock disponible (unidades)',$kpi['disponible'],'success'],['Stock reservado (unidades)',$kpi['reservado'],'info'],['Registros con stock bajo',$kpi['bajo'],'warning']]; @endphp
@include('kpis.tarjetas')
<div class="card"><div class="card-header"><h3 class="card-title">Inventario con stock bajo</h3></div><div class="card-body table-responsive"><table class="table table-striped"><thead><tr><th>Producto</th><th>Talla</th><th>Color</th><th>Disponible</th><th>Mínimo</th></tr></thead><tbody>
@forelse($bajos as $fila)<tr><td>{{ $fila->nombre }}</td><td>{{ $fila->talla ?? '—' }}</td><td>{{ $fila->color ?? '—' }}</td><td>{{ $fila->stock_disponible }}</td><td>{{ $fila->stock_minimo }}</td></tr>@empty<tr><td colspan="5">No hay registros con stock bajo.</td></tr>@endforelse
</tbody></table></div></div>
@stop
