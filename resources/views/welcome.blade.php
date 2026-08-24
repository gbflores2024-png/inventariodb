<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="/">
            InventarioDB
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('categorias.index') }}">
                        Categorías
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('productos.index') }}">
                        Productos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('clientes.index') }}">
                        Clientes
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('reservas.index') }}">
                        Reservas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('pedidos.index') }}">
                        Pedidos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('ventas.index') }}">
                        Ventas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('devoluciones.index') }}">
                        Devoluciones
                    </a>
                </li>

                <li class="nav-item">
    <a class="nav-link"
       href="{{ route('inventarios.index') }}">
        Inventario
    </a>
</li>

            </ul>

        </div>

    </div>
</nav>

<div class="container mt-4">

    @yield('contenido')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>