<div class="container mt-5">
    <h1 class="mb-4 text-center">Gestión de Tamaños</h1>

    <div class="card p-3 mb-4">
        <h5>Buscar Tamaño</h5>
        <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" id="filter-tamanio" class="form-control" placeholder="Nombre del Tamaño...">
                    <button id="filter-btn" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <button class="btn btn-secondary" id="todos-tamanios" style="width:6.5rem; height: 2.8rem;">Todos</button>
        </div>
    </div>

    <div class="text-right mb-3">
        <button class="btn btn-success" id="addTamanio">Agregar Tamaño</button>
    </div>

    <div class="card p-3">
        <h5 class="mb-3">Listado de Tamaño</h5>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tamanio-table">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Tamaño</th>
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

<div class="modal fade" id="addTamanioModal" tabindex="-1" aria-labelledby="addTamanioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="addTamanioModalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTamanioForm" enctype="multipart/form-data">
                    <div class="row mb-3">                       
                        <div class="col-md-6">
                            <label for="tamanio" class="form-label">Nombre del Tamaño</label>
                            <input type="text" class="form-control" id="tamanio" name="tamanio" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveTamanioBtn">Guardar Tamaño</button>
            </div>
        </div>
    </div>
</div>


<script> var baseUrl= "{{ url('/') }}"; </script>
<script src="{{asset('js/tamanios.js')}}"></script>