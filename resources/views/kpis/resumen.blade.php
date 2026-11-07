@extends('kpis.layout', ['titulo' => 'Resumen general'])
@section('kpi_content')
@php $tarjetas = [['Ingresos por ventas', 'Bs '.number_format($kpi['ingresos'],2,',','.'), 'primary'],['Ventas registradas',$kpi['ventas'],'success'],['Productos registrados',$kpi['productos'],'info'],['Stock disponible',$kpi['disponible'],'success'],['Stock reservado',$kpi['reservado'],'secondary'],['Registros con stock bajo',$kpi['bajo'],'warning'],['Pedidos registrados',$kpi['pedidos'],'info'],['Devoluciones registradas',$kpi['devoluciones'],'danger']]; @endphp
@include('kpis.tarjetas')
<div class="card card-outline card-info"><div class="card-header"><h3 class="card-title">Ventas mensuales (últimos 12 meses)</h3></div><div class="card-body"><div style="height:320px"><canvas id="ventasMensualesKpi"></canvas></div><p class="text-muted small mt-2">Los meses sin ventas se muestran con valor cero.</p></div></div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.8/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
 const canvas = document.getElementById('ventasMensualesKpi');
 if (!canvas || typeof Chart === 'undefined') return;
 new Chart(canvas, {type:'bar', data:{labels:@json($meses['labels']), datasets:[{label:'Ingresos (Bs)',data:@json($meses['montos']),backgroundColor:'rgba(23,104,181,.65)'}]}, options:{responsive:true,maintainAspectRatio:false,scales:{y:{beginAtZero:true}}}});
});
</script>
@stop
