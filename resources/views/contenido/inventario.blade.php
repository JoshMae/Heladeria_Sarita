<div class="container mt-4">
    <div class="nav-bar mb-4">
        <a href="#" data-contenido="productos" class="nav-item">Productos</a>
        <a href="#" data-contenido="categorias" class="nav-item">Categorías</a>
        <a href="#" data-contenido="tamanios" class="nav-item">Tamaño</a>
    </div>

    <div id="contenido-inventario">
        <!-- El contenido dinámico se cargará aquí -->
    </div>
</div>

<script>
    var baseUrl = "{{ url('/') }}";
</script>
<script src="{{ asset('js/inventario.js') }}"></script>