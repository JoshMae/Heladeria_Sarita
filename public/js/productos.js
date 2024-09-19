$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Función para cargar las categorías en los selects
    function loadCategories() {
        return $.ajax({
            url: `${baseUrl}/categorias`,
            method: 'GET'
        });
    }

    // Función para cargar los sabores en el select del modal
    function loadSabores() {
        return $.ajax({
            url: `${baseUrl}/sabores`,
            method: 'GET'
        });
    }

    // Función para cargar los tamaños en el select del modal
    function loadTamanios() {
        return $.ajax({
            url: `${baseUrl}/tamanios`,
            method: 'GET'
        });
    }

    //funcion para cargar los destinos en el select del modal
    function loadDestinos(){
        return $.ajax({
            url: `${baseUrl}/destinos`,
            method:'GET',
            success: function(data) {
                console.log("Respuesta de loadDestinos:", data); // Verificar la respuesta
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar destinos:", error);
            }
        });
    }

    // Función para llenar un select
    function fillSelect(selectId, data, valueField, textField, defaultOption = null) {
        const select = $(`#${selectId}`);
        select.empty();
        if (defaultOption) {
            select.append($('<option>', defaultOption));
        }
        $.each(data, function(i, item) {
            select.append($('<option>', {
                value: item[valueField],
                text: item[textField]
            }));
        });
    }

    // Función para limpiar el formulario
    function clearForm() {
        $('#addProductForm')[0].reset();
        $('#previewImagen').attr('src', '').hide();
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
                    let cant= producto.cantidad;
                    if(cant===null){
                        cant='N/A';
                    }
                    tableBody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${producto.codigo}</td>
                            <td>${producto.categoria ? producto.categoria.nombreCategoria : ''}</td>
                            <td>${producto.nombreProducto}</td>
                            <td>${producto.sabor ? producto.sabor.nombreSabor : ''}</td>
                            <td>${producto.tamanio ? producto.tamanio.tamanio : ''}</td>
                            <td>Q. ${producto.precioVenta}</td>
                            <td>${cant}</td>
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

    let option = 1;
    let currentProductId = null;
    
    // Cargar datos iniciales
    Promise.all([loadCategories(), loadProducts()])
        .then(([categorias]) => {
            fillSelect('filter-categoria', categorias, 'idCategoria', 'nombreCategoria', { value: '', text: 'Todas las categorías' });
        })
        .catch(error => console.error("Error al cargar datos iniciales:", error));

    // Manejar la búsqueda y filtrado
    $('#filter-btn').on('click', function() {
        const filters = {
            codigo: $('#filter-codigo').val(),
            nombre: $('#filter-nombre').val(),
            idCategoria: $('#filter-categoria').val(),
            destino: $('#filter-destino').val()
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

    function loadProductData(productId) {
        return $.ajax({
            url: `${baseUrl}/productos/${productId}`,
            method: 'GET'
        });
    }

    // Función para preparar el modal de edición
    function prepareEditModal(productId) {
        currentProductId = productId;  
        Promise.all([
            loadCategories(),
            loadSabores(),
            loadTamanios(),
            loadDestinos(),  
            loadProductData(productId)
        ]).then(([categorias, sabores, tamanios, destinos, producto]) => {
            
            fillSelect('idCategoria', categorias, 'idCategoria', 'nombreCategoria', { value: '', text: 'Seleccione una Categoría' });
            fillSelect('idSabor', sabores, 'idSabor', 'nombreSabor', { value: '', text: 'Seleccione un sabor' });
            fillSelect('idTamanio', tamanios, 'idTamanio', 'tamanio', { value: '', text: 'Seleccione un tamaño' });
            fillSelect('idProductoDestino', destinos, 'idProductoDestino', 'destino', { value: '', text: 'Seleccione un Destino' });
        
            $('#idCategoria').val(producto.idCategoria);
            $('#nombreProducto').val(producto.nombreProducto);
            $('#idSabor').val(producto.idSabor);
            $('#idTamanio').val(producto.idTamanio);
            $('#precioVenta').val(producto.precioVenta);
            $('#cantidad').val(producto.cantidad);
            $('#idProductoDestino').val(producto.idProductoDestino);
        
            let rutaCompleta = producto.imagen ? `${baseUrl}/${producto.imagen}` : '';
            if (producto.imagen) {
                $('#previewImagen').attr('src', rutaCompleta).show();
            } else {
                $('#previewImagen').hide();
            }
        
            option = 2;
            $('#addProductModalLabel').text('Actualizar Producto');
            $('#addProductModal').modal('show');
        }).catch(error => {
            console.error("Error al preparar el modal de edición:", error);
        });
        
    }

    //abre modal para editar un producto
    $(document).on('click', '.edit-product', function(){
        const productId = $(this).data('id');
        prepareEditModal(productId);
    });

    // Abrir modal para agregar producto
    $('#add-product-btn').on('click', function() {
        Promise.all([loadCategories(), loadSabores(), loadTamanios(), loadDestinos()])
            .then(([categorias, sabores, tamanios, destinos]) => {
                fillSelect('idCategoria', categorias, 'idCategoria', 'nombreCategoria', { value: '', text: 'Seleccione una Categoría' });
                fillSelect('idSabor', sabores, 'idSabor', 'nombreSabor', { value: '', text: 'Seleccione un sabor' });
                fillSelect('idTamanio', tamanios, 'idTamanio', 'tamanio', { value: '', text: 'Seleccione un tamaño' });
                fillSelect('idProductoDestino', destinos, 'idProductoDestino', 'destino', { value: '', text: 'Seleccione un Destino' });

                clearForm();
                option = 1;
                $('#addProductModalLabel').text("Agregar Nuevo Producto");
                $('#addProductModal').modal('show');
            })
            .catch(error => console.error("Error al preparar el modal de agregar:", error));
    });

    function saveOrEdit() {
        let formData = new FormData($('#addProductForm')[0]);
        
        if ($('#imagen')[0].files[0]) {
            formData.append('imagen', $('#imagen')[0].files[0]);
        }
        
        const url = option === 1 ? `${baseUrl}/productos` : `${baseUrl}/productos/${currentProductId}`;
        const method = option === 1 ? 'POST' : 'PUT';

        // If it's an update (PUT) request, we need to append the _method field
        if (method === 'PUT') {
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            type: 'POST',  // Always use POST for FormData
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    alert(option === 1 ? 'Producto guardado exitosamente' : 'Producto Actualizado con Éxito');
                    $('#addProductModal').modal('hide');
                    loadProducts();
                } else {
                    alert(option === 1 ? 'Error al guardar el producto' : 'No se pudo actualizar el producto');
                }
            },
            error: function(xhr) {
                let errorMessage = `Error al ${option === 1 ? 'guardar' : 'actualizar'} el producto:\n`;
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
    }

    // Guardar nuevo producto o actualizar existente
    $('#saveProductBtn').on('click', function() {
        saveOrEdit();
    });

    // Asegura que el modal se cierre cuando se hace clic en el botón Cancelar
    $('.btn-secondary').on('click', function() {
        clearForm();
        $('#addProductModal').modal('hide');
    });

    // También cierra correctamente cuando se hace clic en la X
    $('.close').on('click', function() {
        clearForm();
        $('#addProductModal').modal('hide');
    });

    $('#addProductModal').on('hidden.bs.modal', function () {
        clearForm();
    });
});