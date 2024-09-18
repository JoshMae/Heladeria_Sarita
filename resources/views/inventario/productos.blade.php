
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
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title text-white" id="addProductModalLabel"></h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="addProductForm" enctype="multipart/form-data">
                  <div class="row mb-3">
                      <div class="col-md-6">
                          <label for="idCategoria" class="form-label">Categoría</label>
                          <select class="form-select" id="idCategoria" name="idCategoria" required>
                              <!-- Las opciones se cargarán dinámicamente -->
                          </select>
                      </div>
                      <div class="col-md-6">
                          <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                          <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
                      </div>
                  </div>

                  <div class="row mb-3">
                      <div class="col-md-4">
                          <label for="idSabor" class="form-label">Sabor</label>
                          <select class="form-select" id="idSabor" name="idSabor" required>
                              <!-- Las opciones se cargarán dinámicamente -->
                          </select>
                      </div>
                      <div class="col-md-4">
                          <label for="idTamanio" class="form-label">Tamaño</label>
                          <select class="form-select" id="idTamanio" name="idTamanio" required>
                              <!-- Las opciones se cargarán dinámicamente -->
                          </select>
                      </div>
                      <div class="col-md-4">
                          <label for="precioVenta" class="form-label">Precio de Venta</label>
                          <input type="number" class="form-control" id="precioVenta" name="precioVenta" step="0.01" required>
                      </div>
                  </div>

                  <div class="row mb-3">
                      <div class="col-md-6">
                          <label for="cantidad" class="form-label">Cantidad</label>
                          <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                      </div>
                  </div>

                  <div class="col-md-12 d-flex align-items-start">
                    <!-- Input de archivo -->
                    <div class="input-container" style="margin-right: 1rem;">
                      <label for="imagen" class="form-label">Imagen</label>
                      <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                    </div>
                  
                    <!-- Campo de previsualización con cuadro más elevado y sin ícono por defecto -->
                    <div class="preview-container" style="border: 1px solid #ccc; width: 15em; height: 15em; display: flex; justify-content: center; align-items: center; margin-top: -5rem; margin-left: 2rem; background-color: #f8f8f8;">
                      <img id="previewImagen" src="" alt="Previsualización de la imagen" style="max-width: 100%; max-height: 100%; object-fit: contain; display: none;">
                    </div>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="saveProductBtn">Guardar Producto</button>
          </div>
      </div>
  </div>
</div>

<script> var baseUrl = "{{ url('/') }}"; </script>
<script src="{{ asset('js/productos.js') }}"></script>

<script>
  // Función para previsualizar la imagen
  document.getElementById('imagen').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('previewImagen');
    
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block'; // Muestra la imagen
      };
      reader.readAsDataURL(file);
    } else {
      preview.src = '';
      preview.style.display = 'none'; // Oculta el área si no hay imagen seleccionada
    }
  });
</script>
