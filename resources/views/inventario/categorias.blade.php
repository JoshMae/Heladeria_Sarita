<div class="container mt-5">
    <h1 class="mb-4 text-center">Gestión de Categorias</h1>

    <div class="card p-3 mb-4">
        <h5>Buscar Categoria</h5>
        <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" id="filter-categoria" class="form-control" placeholder="Nombre de la Categoria">
                    <button id="filter-btn" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <button class="btn btn-secondary" id="todas-categoria" style="width:6.5rem; height: 2.8rem;">Todos</button>
        </div>
    </div>

    <div class="text-right mb-3">
        <button class="btn btn-success" id="addCategoria">Agregar Categoria</button>
    </div>

    <div class="card p-3">
        <h5 class="mb-3">Listado de Categorias</h5>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="categoria-table">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Categoria</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!--Se cargara de manera Dinamica-->
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addCategoriaModal" tabindex="-1" aria-labelledby="addCategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="addCategoriaModalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCategoriaForm" enctype="multipart/form-data">
                    <div class="row mb-3">                       
                        <div class="col-md-6">
                            <label for="nombreCategoria" class="form-label">Nombre de la Categoria</label>
                            <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria" required>
                        </div>
                    </div>
                    <div class="row mb-3">                       
                        <div class="col-md-12" >
                            <label for="descripcion" class="form-label">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                    </div>
  
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveCategoriaBtn">Guardar Categoria</button>
            </div>
        </div>
    </div>
</div>


<script> var baseUrl= "{{ url('/') }}"; </script>
<script src="{{asset('js/categorias.js')}}"></script>