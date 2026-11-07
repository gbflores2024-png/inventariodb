<div class="row">
@foreach($tarjetas as $tarjeta)
<div class="col-lg-3 col-md-6"><div class="small-box bg-{{ $tarjeta[2] }}"><div class="inner"><h3>{{ $tarjeta[1] }}</h3><p>{{ $tarjeta[0] }}</p></div><div class="icon"><i class="fas fa-chart-bar"></i></div></div></div>
@endforeach
</div>
