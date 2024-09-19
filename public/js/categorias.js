$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let currentCategoriaId = null;
    let option=1;
    //funcion para cargar productos
    function loadCategories(filters = {}) {
        $.ajax({
            url: `${baseUrl}/categorias`,
            method: 'GET',
            data: filters,
            success: function(response) {
                const tableBody = $('#categoria-table tbody');
                tableBody.empty();
                
                response.forEach(function(categoria, index) {
                    tableBody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${categoria.nombreCategoria}</td>
                            <td>${categoria.descripcion}</td>
                            <td>
                                <button style="background-color: rgb(216, 219, 6); " class="btn btn-sm btn-primary edit-categoria" data-id="${categoria.idCategoria}">Editar</button>
                                <button style="background-color: rgb(212, 6, 6); color: white;" class="btn btn-sm btn-danger delete-categoria" data-id="${categoria.idCategoria}">Eliminar</button>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar las categorias:", error);
            }
        });
    }

    //Muestra todo desde el inicio
    loadCategories();

    //Aplica Filtro
    $('#filter-btn').on('click', function() {
        const filters = { nombre: $('#filter-categoria').val()};
        loadCategories(filters);
        $('#filter-categoria').val('');
        
    });

    //Quita filtro
    $('#todas-categoria').on('click', function(){
        loadCategories();
    }); 

    function loadCategoriaData(categoriaId) {
        return $.ajax({
            url: `${baseUrl}/categorias/${categoriaId}`,
            method: 'GET'
        });
    }

    //Prepara el Modal para editarlo
    function prepareEditModal(categoriaId) {
        currentCategoriaId = categoriaId;
        Promise.all([  
            loadCategoriaData(categoriaId)
        ]).then(([categoria]) => {  
            $('#nombreCategoria').val(categoria.nombreCategoria);
            $('#descripcion').val(categoria.descripcion);
            option = 2;
            $('#addCategoriaModalLabel').text('Actualizar Categoria');
            $('#addCategoriaModal').modal('show');
        }).catch(error => {
            console.error("Error al preparar el modal de edición:", error);
        });    
    }

    $(document).on('click', '.edit-categoria', function(){
        const categoriaId = $(this).data('id');
        prepareEditModal(categoriaId);
    });


    //Abre modal para agregar categoria
    $('#addCategoria').on('click', function(){
        option = 1;
        clearForm();
        $('#addCategoriaModalLabel').text("Agregar Nueva Categoria");
        $('#addCategoriaModal').modal('show');
    });

    //Agrega Nueva Categoria
    $('#saveCategoriaBtn').on('click', function() {
        let formData = new FormData($('#addCategoriaForm')[0]);

        const url = option === 1 ? `${baseUrl}/categorias` : `${baseUrl}/categorias/${currentCategoriaId}`;
        const method = option === 1 ? 'POST' : 'PUT';

        if (method === 'PUT') {
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            type: 'POST',  
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    alert(option === 1 ? 'Categoria guardada exitosamente' : 'Categoria Actualizada con Éxito');
                    $('#addCategoriaModal').modal('hide');
                    loadCategories();
                } else {
                    alert(option === 1 ? 'Error al guardar la categoria' : 'No se pudo actualizar la categoria');
                }
            },
            error: function(xhr) {
                let errorMessage = `Error al ${option === 1 ? 'guardar' : 'actualizar'} la categoria:\n`;
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        errorMessage += `${field}: ${errors[field].join(', ')}\n`;
                    }
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage += xhr.responseJSON.message;
                } else {
                    errorMessage += 'Ocurrió un error desconocido';
                }
                alert(errorMessage);
                console.log('Error completo:', xhr.responseJSON);
            }
        });

    }); 



    //elimimnar categoria
    $(document).on('click', '.delete-categoria', function(){
        const categoriaId = $(this).data('id');
        if (confirm('¿Estás seguro de que quieres eliminar esta categoria?')) {
            $.ajax({
                url: `${baseUrl}/categorias/${categoriaId}`,
                method: 'DELETE',
                success: function() {
                    alert('Categoria eliminada con éxito');
                    loadCategories();
                },
                error: function(xhr, status, error) {
                    console.error("Error al eliminar la categoria:", error);
                    alert('Hubo un error al eliminar la categoria');
                }
            });
        }
    });

    function clearForm() {
        $('#addCategoriaForm')[0].reset();
    }
    $('#addCategoriaModal').on('hidden.bs.modal', function () {
        clearForm();
    });
});