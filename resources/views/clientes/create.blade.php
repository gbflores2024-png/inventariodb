@extends('welcome')

@section('contenido')

<h2>Nuevo Cliente</h2>

<form action="{{ route('clientes.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text"
               name="nombre"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email"
               name="email"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Teléfono</label>
        <input type="text"
               name="telefono"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Dirección</label>
        <input type="text"
               name="direccion"
               class="form-control">
    </div>

    <button class="btn btn-primary">
        Guardar
    </button>

</form>

@endsection