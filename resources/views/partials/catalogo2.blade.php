<section class="principle-section image-background" style="background-image: url('{{ asset($image1->first()->direccion) }}');">
    <img src="{{asset($image2->first()->direccion)}}" alt="cinta negra" class="imagenEnca paleta">
    <img src="{{asset($image3->first()->direccion)}}" alt="nevada" class="imagenEnca cono">
    <img src="{{asset($image4->first()->direccion)}}" alt="banana" class="imagenEnca sundae">
    <img src="{{ asset('imagenes/comparte.svg') }}" alt="comparte" class="comparte">
</section>

<div class="image-container">
    <section>
        <a href="https://heladosarita.com/nuestros-productos/sarita/"><img src="{{ asset('images/helados.png') }}" alt="Normal"></a>
    </section>
    <section>
        <a href="https://heladosarita.com/nuestros-productos/sarita/"><img src="{{ asset('images/yogurt.png') }}" alt="Yogurt"></a>
    </section>
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

{{-- script --}}
<script>
    document.querySelector('.comparte').addEventListener('mousemove', function(e) {
        const compartImage = e.currentTarget;
        const rect = compartImage.getBoundingClientRect();
        
        // Calcula la posición del mouse en relación a la imagen
        const mouseX = e.clientX - rect.left;
        const mouseY = e.clientY - rect.top;
        
        // Calcula los movimientos opuestos basados en la posición del mouse
        const moveX = (rect.width / 2 - mouseX) / 10;
        const moveY = (rect.height / 2 - mouseY) / 10;
    
        // Aplica el movimiento opuesto al mouse
        compartImage.style.transform = `translate(${moveX}px, ${moveY}px)`;
    });
    
    document.querySelector('.comparte').addEventListener('mouseleave', function(e) {
        // Restaura la imagen a su posición original cuando el mouse sale
        e.currentTarget.style.transform = 'translate(0, 0)';
    });
</script>