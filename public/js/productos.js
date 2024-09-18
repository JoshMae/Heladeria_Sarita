$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Función para cargar las categorías en los selects
    function loadCategories() {
        const ids = ['filter-categoria', 'idCategoria']; 
        $.ajax({
            url: `${baseUrl}/categorias`,
            method: 'GET',
            success: function(response) {
                ids.forEach(function(id) {
                    const select = $(`#${id}`);
                    select.empty();
                    select.append($('<option>', {
                        value: '',
                        text: 'Todas las categorías'
                    }));
                    $.each(response, function(i, categoria) {
                        select.append($('<option>', {
                            value: categoria.idCategoria,
                            text: categoria.nombreCategoria
                        }));
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar las categorías:", error);
            }
        });
    }

    // Función para cargar los sabores en el select del modal
    function loadSabores() {
        $.ajax({
            url: `${baseUrl}/sabores`,
            method: 'GET',
            success: function(response) {
                const select = $('#idSabor');
                select.empty();
                select.append($('<option>', {
                    value: '',
                    text: 'Seleccione un sabor'
                }));
                $.each(response, function(i, sabor) {
                    select.append($('<option>', {
                        value: sabor.idSabor,
                        text: sabor.nombreSabor
                    }));
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar los sabores:", error);
            }
        });
    }

    // Función para cargar los tamaños en el select del modal
    function loadTamanios() {
        $.ajax({
            url: `${baseUrl}/tamanios`,
            method: 'GET',
            success: function(response) {
                const select = $('#idTamanio');
                select.empty();
                select.append($('<option>', {
                    value: '',
                    text: 'Seleccione un tamaño'
                }));
                $.each(response, function(i, tamanio) {
                    select.append($('<option>', {
                        value: tamanio.idTamanio,
                        text: tamanio.tamanio
                    }));
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar los tamaños:", error);
            }
        });
    }

    // Función para cargar los productos
    function loadProducts(filters = {}) {
        $.ajax({
            url: `${baseUrl}/productos`,
            method: 'GET',
            data: filters,
            success: function(response) {
                const tableBody = $('#productos-table tbody');
                tableBody.empty();

                response.forEach(function(producto, index) {
                    tableBody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${producto.codigo}</td>
                            <td>${producto.categoria ? producto.categoria.nombreCategoria : ''}</td>
                            <td>${producto.nombreProducto}</td>
                            <td>${producto.sabor ? producto.sabor.nombreSabor : ''}</td>
                            <td>${producto.tamanio ? producto.tamanio.tamanio : ''}</td>
                            <td>Q. ${producto.precioVenta}</td>
                            <td>${producto.cantidad}</td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-product" data-id="${producto.idProducto}">Editar</button>
                                <button class="btn btn-sm btn-danger delete-product" data-id="${producto.idProducto}">Eliminar</button>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar los productos:", error);
            }
        });
    }

    // Cargar datos iniciales
    loadCategories();
    loadProducts();

    // Manejar la búsqueda y filtrado
    $('#filter-btn').on('click', function() {
        const filters = {
            codigo: $('#filter-codigo').val(),
            nombre: $('#filter-nombre').val(),
            idCategoria: $('#filter-categoria').val()
        };
        loadProducts(filters);

        $('#filter-codigo').val('');  
        $('#filter-nombre').val('');
    });

    // Manejar la eliminación de productos
    $(document).on('click', '.delete-product', function() {
        const productId = $(this).data('id');
        if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
            $.ajax({
                url: `${baseUrl}/productos/${productId}`,
                method: 'DELETE',
                success: function() {
                    alert('Producto eliminado con éxito');
                    loadProducts();
                },
                error: function(xhr, status, error) {
                    console.error("Error al eliminar el producto:", error);
                    alert('Hubo un error al eliminar el producto');
                }
            });
        }
    });

    // Abrir modal para agregar producto
    $('#add-product-btn').on('click', function() {
        loadCategories();
        loadSabores();
        loadTamanios();
        $('#addProductModal').modal('show');
    });

    

    // Guardar nuevo producto
    $('#saveProductBtn').on('click', function() {
        let formData = new FormData($('#addProductForm')[0]);
        
        
        if ($('#imagen')[0].files[0]) {
            formData.append('imagen', $('#imagen')[0].files[0]);
        }

        formData.append('tipoGuardado', '2');

        // Depuración: Mostrar todos los datos del formulario
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }


        $.ajax({
            url: `${baseUrl}/productos`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    alert('Producto guardado exitosamente');
                    $('#addProductModal').modal('hide');
                    loadProducts();
                    // Aquí puedes agregar código para actualizar la lista de productos
                } else {
                    alert('Error al guardar el producto');
                }
            },
            error: function(xhr) {
                let errorMessage = 'Error al guardar el producto:\n';
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

   
        // Asegura que el modal se cierre cuando se hace clic en el botón Cancelar
        document.querySelector('.btn-secondary').addEventListener('click', function() {
          $('#addProductModal').modal('hide');
        });
    
        // También cierra correctamente cuando se hace clic en la X
        document.querySelector('.close').addEventListener('click', function() {
          $('#addProductModal').modal('hide');
        });
   
});