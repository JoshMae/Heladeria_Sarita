function cargarContenido(contenido) {
    const url = `${baseUrl}/cargar-contenido-inventario/${contenido}`;
    
    $.ajax({
        url: url,
        type: 'GET',
        beforeSend: function() {
            $('#contenido-inventario').html(`
                <div class="spinner-container">
                    <div class="loader">
                </div>
            `);
        },
        success: function(response) {
            $('#contenido-inventario').html(response);
            localStorage.setItem('ContenidoInventarioActual', contenido);
            actualizarNavActivo(contenido);
        },
        error: function(xhr, status) {
            $('#contenido-inventario').html('<p>Error al cargar el contenido.</p>');
        }
    });
}

function actualizarNavActivo(contenido) {
    $('.nav-bar .nav-item').removeClass('active');
    $(`.nav-bar a[data-contenido="${contenido}"]`).addClass('active');
}

$(document).ready(function() {
    $('.nav-bar .nav-item').on('click', function(e) {
        e.preventDefault();
        const contenido = $(this).data('contenido');
        cargarContenido(contenido);
    });

    // Cargar el último contenido al iniciar la página
    const ultimoContenido = localStorage.getItem('ContenidoInventarioActual');
    if (ultimoContenido) {
        cargarContenido(ultimoContenido);
    } else {
        // Si no hay contenido guardado, cargar productos por defecto
        cargarContenido('productos');
    }
});