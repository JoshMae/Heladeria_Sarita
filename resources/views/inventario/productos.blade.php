
<div class="container mt-5">
    <h1 class="mb-4 text-center">Gestión de Productos</h1>

    <!-- Formulario de Filtro -->
    <div class="card p-3 mb-4">
        <h5>Filtrar Productos</h5>
        <div class="row">
            <div class="col-md-4">
                <label for="filter-codigo">Código</label>
                <input type="text" id="filter-codigo" class="form-control" placeholder="Código del producto">
            </div>
            <div class="col-md-4">
                <label for="filter-nombre">Nombre</label>
                <input type="text" id="filter-nombre" class="form-control" placeholder="Nombre del producto">
            </div>
            <div class="col-md-4">
                <label for="filter-categoria">Categoría</label>
                <select id="filter-categoria" class="form-control">
                    <option value="">Todas las categorías</option>
                </select>
            </div>
        </div>
        <div class="mt-3 text-right">
            <button id="filter-btn" class="btn btn-primary">Aplicar Filtros</button>
        </div>
    </div>

    <!-- Botón para Agregar Producto -->
    <div class="text-right mb-3">
        <button class="btn btn-success" id="add-product-btn">Agregar Producto</button>
    </div>

    <!-- Tabla de Productos -->
    <div class="card p-3">
        <h5 class="mb-3">Lista de Productos</h5>
        <table class="table table-striped table-hover" id="productos-table">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Código</th>
                    <th>Categoría</th>
                    <th>Nombre</th>
                    <th>Sabor</th>
                    <th>Tamaño</th>
                    <th>Precio Venta</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se cargarán los productos dinámicamente -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para Agregar Producto -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Agregar Nuevo Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="addProductForm" enctype="multipart/form-data">
            <div class="form-group">
              <label for="idCategoria">Categoría</label>
              <select class="form-control" id="idCategoria" name="idCategoria" required>
                <!-- Las opciones se cargarán dinámicamente -->
              </select>
            </div>
            <div class="form-group">
              <label for="nombreProducto">Nombre del Producto</label>
              <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
            </div>
            <div class="form-group">
              <label for="idSabor">Sabor</label>
              <select class="form-control" id="idSabor" name="idSabor" required>
                <!-- Las opciones se cargarán dinámicamente -->
              </select>
            </div>
            <div class="form-group">
              <label for="idTamanio">Tamaño</label>
              <select class="form-control" id="idTamanio" name="idTamanio" required>
                <!-- Las opciones se cargarán dinámicamente -->
              </select>
            </div>
            <div class="form-group">
              <label for="precioVenta">Precio de Venta</label>
              <input type="number" class="form-control" id="precioVenta" name="precioVenta" step="0.01" required>
            </div>
            <div class="form-group">
              <label for="cantidad">Cantidad</label>
              <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            <div class="form-group">
              <label for="imagen">Imagen</label>
              <input type="file" class="form-control-file" id="imagen" name="imagen">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="saveProductBtn">Guardar Producto</button>
        </div>
      </div>
    </div>
</div>

<script> var baseUrl = "{{ url('/') }}"; </script>
<script src="{{ asset('js/productos.js') }}"></script>
