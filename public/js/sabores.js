$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let currentSaborId = null;
    let option=1;
    //funcion para cargar productos
    function loadSabores(filters = {}) {
        $.ajax({
            url: `${baseUrl}/sabores`,
            method: 'GET',
            data: filters,
            success: function(response) {
                const tableBody = $('#sabor-table tbody');
                tableBody.empty();
                
                response.forEach(function(sabor, index) {
                    tableBody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${sabor.nombreSabor}</td>
                            <td>
                                <button style="background-color: rgb(216, 219, 6); " class="btn btn-sm btn-primary edit-sabor" data-id="${sabor.idSabor}">Editar</button>
                                <button style="background-color: rgb(212, 6, 6); color: white;" class="btn btn-sm btn-danger delete-sabor" data-id="${sabor.idSabor}">Eliminar</button>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar los sabores:", error);
            }
        });
    }

    //Muestra todo desde el inicio
    loadSabores();

    //Aplica Filtro
    $('#filter-btn').on('click', function() {
        const filters = { nombreSabor: $('#filter-sabor').val()};
        loadSabores(filters);
        $('#filter-sabor').val('');
        
    });

    //Quita filtro
    $('#todos-sabores').on('click', function(){
        loadSabores();
    }); 

    function loadSaboresData(saborId) {
        return $.ajax({
            url: `${baseUrl}/sabores/${saborId}`,
            method: 'GET'
        });
    }

    //Prepara el Modal para editarlo
    function prepareEditModal(saborId) {
        currentSaborId = saborId;
        Promise.all([  
            loadSaboresData(saborId)
        ]).then(([sabor]) => {  
            $('#nombreSabor').val(sabor.nombreSabor);
            option = 2;
            $('#addSaborModalLabel').text('Actualizar Sabor');
            $('#addSaborModal').modal('show');
        }).catch(error => {
            console.error("Error al preparar el modal de edición:", error);
        });    
    }

    $(document).on('click', '.edit-sabor', function(){
        const saborId = $(this).data('id');
        prepareEditModal(saborId);
    });


    //Abre modal para agregar categoria
    $('#addSabor').on('click', function(){
        option = 1;
        clearForm();
        $('#addSaborModalLabel').text("Agregar Nuevo Sabor");
        $('#addSaborModal').modal('show');
    });

    //Agrega Nueva Categoria
    $('#saveSaborBtn').on('click', function() {
        let formData = new FormData($('#addSaborForm')[0]);

        const url = option === 1 ? `${baseUrl}/sabores` : `${baseUrl}/sabores/${currentSaborId}`;
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
                    alert(option === 1 ? 'Sabor guardado exitosamente' : 'Ssabor Actualizado con Éxito');
                    $('#addSaborModal').modal('hide');
                    loadSabores();
                } else {
                    alert(option === 1 ? 'Error al guardar el sabor' : 'No se pudo actualizar el sabor');
                }
            },
            error: function(xhr) {
                let errorMessage = `Error al ${option === 1 ? 'guardar' : 'actualizar'} el sabor:\n`;
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
    $(document).on('click', '.delete-sabor', function(){
        const saborId = $(this).data('id');
        if (confirm('¿Estás seguro de que quieres eliminar este sabor?')) {
            $.ajax({
                url: `${baseUrl}/sabores/${saborId}`,
                method: 'DELETE',
                success: function() {
                    alert('Sabor eliminado con éxito');
                    loadSabores();
                },
                error: function(xhr, status, error) {
                    console.error("Error al eliminar el Sabor:", error);
                    alert('Hubo un error al eliminar el Sabor');
                }
            });
        }
    });

    function clearForm() {
        $('#addSaborForm')[0].reset();
    }
    $('#addSaborModal').on('hidden.bs.modal', function () {
        clearForm();
    });
});