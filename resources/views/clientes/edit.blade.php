@extends('welcome')

@section('contenido')

<h2>Editar Cliente</h2>

<form action="{{ route('clientes.update',$cliente->id_cliente) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text"
               name="nombre"
               class="form-control"
               value="{{ $cliente->nombre }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email"
               name="email"
               class="form-control"
               value="{{ $cliente->email }}">
    </div>

    <div class="mb-3">
        <label>Teléfono</label>
        <input type="text"
               name="telefono"
               class="form-control"
               value="{{ $cliente->telefono }}">
    </div>

    <div class="mb-3">
        <label>Dirección</label>
        <input type="text"
               name="direccion"
               class="form-control"
               value="{{ $cliente->direccion }}">
    </div>

    <button class="btn btn-primary">
        Actualizar
    </button>

</form>

@endsection