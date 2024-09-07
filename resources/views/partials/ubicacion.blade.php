<div id="ubicacion-content" class="container py-5">
    <h1 class="text-center mb-5">Nuestra Ubicación</h1>
    
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div id="map-container" class="shadow rounded">
                <div id="map" style="height: 400px;"></div>
                <button id="route-btn" class="btn btn-primary btn-lg position-absolute m-3">Cómo Llegar</button>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title">Información de Contacto</h3>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-clock mr-2"></i> Lunes a Viernes: 9:00 AM - 8:00 PM</li>
                        <li><i class="fas fa-phone mr-2"></i> (502) 2020-0000</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> [Dirección de la Heladería]</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-lg-6">
            <h3>Será un Gusto Atenderte</h3>
            <p class="lead">Nuestros horarios de atención se adaptan a ti. Disfruta de nuestros deliciosos helados en un ambiente acogedor y familiar.</p>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('images/fotoFranquicia.jpg') }}" alt="Foto de la tienda" class="img-fluid rounded shadow">
        </div>
    </div>
</div>

<style>
    #ubicacion-content {
        background-color: #f8f9fa;
    }
    
    h1, h3 {
        color: #E90B0B;
    }
    
    #map-container {
        position: relative;
        overflow: hidden;
    }
    
    #route-btn {
        bottom: 10px;
        left: 10px;
        z-index: 1000;
        background-color: #E90B0B;
        border-color: #E90B0B;
    }
    
    #route-btn:hover {
        background-color: #c00909;
        border-color: #c00909;
    }
    
    .card {
        border: none;
        transition: transform 0.3s;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .fas {
        color: #E90B0B;
    }
</style>