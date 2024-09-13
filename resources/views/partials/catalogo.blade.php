@if(isset($images['fondo']) && isset($images['helados']))
    <section class="principle-section" style="background-image: url('{{ asset($images['fondo'][0]->direccion) }}'); background-size: cover; background-position: center; height: 400px; position: relative;">
        @foreach($images['helados'] as $helado)
            <img src="{{ asset($helado->direccion) }}" alt="{{ $helado->nombre }}" style="position: absolute; width: 100px; height: auto; left: {{ $loop->index * 25 }}%; top: 50%; transform: translateY(-50%);">
        @endforeach
    </section>
@else
    <section class="principle-section">
        <p>No se encontraron imágenes para el catálogo</p>
    </section>
@endif

<div class="image-container">
    <a href="https://heladosarita.com/nuestros-productos/sarita/"><img src="{{ asset('images/helados.png') }}" alt="Normal"></a>
    <a href="https://heladosarita.com/nuestros-productos/sarita/"><img src="{{ asset('images/yogurt.png') }}" alt="Yogurt"></a>
</div>

<!-- Barra Inferior-->
<footer class="footer-custom2">
    <div class="footer-content">
        <div class="footer-left">
            <a href="https://wa.me/1234567890" target="_blank" class="footer-link">
                <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" class="icon-redes">
                <span>+502 2020 0000</span>
            </a>
            <a href="https://www.instagram.com/sarita" target="_blank" class="footer-link">
                <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="icon-redes">
                <span>@heladossarita</span>
            </a>
            <a href="https://www.facebook.com/sarita" target="_blank" class="footer-link">
                <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="icon-redes">
                <span>Helados Sarita</span>
            </a>
        </div>
        <div class="footer-right">
            <span class="titulo-inferior">¡ Creamos momentos de alegría !</span>
            <img src="{{ asset('images/icono.png') }}" alt="IconoSarita" class="icon-helado">
        </div>
    </div>
</footer>

