$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let currentTamanioId = null;
    let option=1;
    //funcion para cargar productos
    function loadTamanios(filters = {}) {
        $.ajax({
            url: `${baseUrl}/tamanios`,
            method: 'GET',
            data: filters,
            success: function(response) {
                const tableBody = $('#tamanio-table tbody');
                tableBody.empty();
                
                response.forEach(function(tamanio, index) {
                    tableBody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${tamanio.tamanio}</td>
                            <td>
                                <button style="background-color: rgb(216, 219, 6); " class="btn btn-sm btn-primary edit-tamanio" data-id="${tamanio.idTamanio}">Editar</button>
                                <button style="background-color: rgb(212, 6, 6); color: white;" class="btn btn-sm btn-danger delete-tamanio" data-id="${tamanio.idTamanio}">Eliminar</button>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar los tamaños:", error);
            }
        });
    }

    //Muestra todo desde el inicio
    loadTamanios();

    //Aplica Filtro
    $('#filter-btn').on('click', function() {
        const filters = { tamanio: $('#filter-tamanio').val()};
        loadTamanios(filters);
        $('#filter-tamanio').val('');
        
    });

    //Quita filtro
    $('#todos-tamanios').on('click', function(){
        loadTamanios();
    }); 

    function loadTamaniosData(tamanioId) {
        return $.ajax({
            url: `${baseUrl}/tamanios/${tamanioId}`,
            method: 'GET'
        });
    }

    //Prepara el Modal para editarlo
    function prepareEditModal(tamanioId) {
        currentTamanioId = tamanioId;
        Promise.all([  
            loadTamaniosData(tamanioId)
        ]).then(([tamanio]) => {  
            $('#tamanio').val(tamanio.tamanio);
            option = 2;
            $('#addTamanioModalLabel').text('Actualizar Tamaño');
            $('#addTamanioModal').modal('show');
        }).catch(error => {
            console.error("Error al preparar el modal de edición:", error);
        });    
    }

    $(document).on('click', '.edit-tamanio', function(){
        const tamanioId = $(this).data('id');
        prepareEditModal(tamanioId);
    });


    //Abre modal para agregar categoria
    $('#addTamanio').on('click', function(){
        option = 1;
        clearForm();
        $('#addTamanioModalLabel').text("Agregar Nuevo Tamaño");
        $('#addTamanioModal').modal('show');
    });

    //Agrega Nueva Categoria
    $('#saveTamanioBtn').on('click', function() {
        let formData = new FormData($('#addTamanioForm')[0]);

        const url = option === 1 ? `${baseUrl}/tamanios` : `${baseUrl}/tamanios/${currentTamanioId}`;
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
                    alert(option === 1 ? 'Tamaño guardado exitosamente' : 'Tamaño Actualizado con Éxito');
                    $('#addTamanioModal').modal('hide');
                    loadTamanios();
                } else {
                    alert(option === 1 ? 'Error al guardar el tamaño' : 'No se pudo actualizar el tamaño');
                }
            },
            error: function(xhr) {
                let errorMessage = `Error al ${option === 1 ? 'guardar' : 'actualizar'} el tamaño:\n`;
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



    //elimimnar tamaño
    $(document).on('click', '.delete-tamanio', function(){
        const tamanioId = $(this).data('id');
        if (confirm('¿Estás seguro de que quieres eliminar este tamaño?')) {
            $.ajax({
                url: `${baseUrl}/tamanios/${tamanioId}`,
                method: 'DELETE',
                success: function() {
                    alert('Tamaño eliminado con éxito');
                    loadTamanios();
                },
                error: function(xhr, status, error) {
                    console.error("Error al eliminar el Tamaño:", error);
                    alert('Hubo un error al eliminar el Tamaño');
                }
            });
        }
    });

    function clearForm() {
        $('#addTamanioForm')[0].reset();
    }
    $('#addTamanioModal').on('hidden.bs.modal', function () {
        clearForm();
    });
});