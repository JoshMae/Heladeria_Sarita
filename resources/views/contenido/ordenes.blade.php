<div class="container mt-4">
    <h1 class="mb-4">Gestión de Órdenes</h1>

    <div class="mb-3">
        <button class="btn btn-primary">Nueva Orden</button>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Juan Pérez</td>
                <td>2023-09-17</td>
                <td>$50.00</td>
                <td><span class="badge bg-success">Completada</span></td>
                <td>
                    <button class="btn btn-sm btn-info">Ver</button>
                    <button class="btn btn-sm btn-warning">Editar</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>María López</td>
                <td>2023-09-17</td>
                <td>$75.00</td>
                <td><span class="badge bg-warning">Pendiente</span></td>
                <td>
                    <button class="btn btn-sm btn-info">Ver</button>
                    <button class="btn btn-sm btn-warning">Editar</button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Carlos Rodríguez</td>
                <td>2023-09-16</td>
                <td>$100.00</td>
                <td><span class="badge bg-danger">Cancelada</span></td>
                <td>
                    <button class="btn btn-sm btn-info">Ver</button>
                    <button class="btn btn-sm btn-warning">Editar</button>
                </td>
            </tr>
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Siguiente</a>
            </li>
        </ul>
    </nav>
</div>