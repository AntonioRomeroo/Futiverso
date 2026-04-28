<style>
    .footer {
        background: #070D59 !important;
        color: #ffffff !important;
        padding: 60px 0 20px !important;
        margin-top: 80px !important;
        border-top: 4px solid #F7B633 !important;
        font-family: 'Lexend', sans-serif !important;
        width: 100% !important;
    }
    .footer__grid {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
        align-items: flex-start !important;
        gap: 40px !important;
        max-width: 1100px !important;
        margin: 0 auto 40px !important;
        padding: 0 20px !important;
    }
    .footer__col {
        flex: 1 !important;
    }
    .footer__col:first-child {
        flex: 1.5 !important;
    }
    .footer__title {
        color: #ffffff !important;
        font-size: 18px !important;
        font-weight: bold !important;
        margin-bottom: 20px !important;
        text-transform: uppercase !important;
    }
    .footer__text {
        line-height: 1.6 !important;
        opacity: 0.8 !important;
        font-size: 15px !important;
    }
    .footer__list {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .footer__list li {
        margin-bottom: 12px !important;
    }
    .footer__list a, .footer__social a {
        color: rgba(255,255,255,0.8) !important;
        text-decoration: none !important;
        transition: all 0.3s ease !important;
    }
    .footer__list a:hover {
        color: #F7B633 !important;
        padding-left: 5px !important;
    }
    .footer__social {
        display: flex !important;
        gap: 15px !important;
        margin-top: 20px !important;
    }
    .footer__social a {
        font-size: 24px !important;
    }
    .footer__social a:hover {
        color: #F7B633 !important;
        transform: translateY(-3px) !important;
    }
    .footer__bottom {
        background: #070D59 !important;
        border-top: 1px solid rgba(255,255,255,0.1) !important;
        padding: 30px 0 !important;
        margin-top: 40px !important;
        width: 100% !important;
    }
    .footer__bottomGrid {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        max-width: 1100px !important;
        margin: 0 auto !important;
        padding: 0 20px !important;
        font-size: 14px !important;
        color: rgba(255,255,255,0.8) !important;
    }
    .footer__trust {
        display: flex !important;
        gap: 15px !important;
        font-size: 22px !important;
        align-items: center !important;
    }
    .footer__trust span {
        font-size: 14px !important;
    }
</style>

<footer class="footer">
    <div class="wrap footer__grid">

        <div class="footer__col">
            <h3 class="footer__title">Futiverso</h3>
            <p class="footer__text">
                Tu tienda de fútbol: camisetas, equipaciones y ofertas cada semana.
            </p>

            <div class="footer__social">
                <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                <a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>

        <div class="footer__col">
            <h3 class="footer__title">Ayuda</h3>
            <ul class="footer__list">
                <li><a href="#">Envíos y devoluciones</a></li>
                <li><a href="#">Preguntas frecuentes</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Seguimiento de pedido</a></li>
            </ul>
        </div>

        <div class="footer__col">
            <h3 class="footer__title">Empresa</h3>
            <ul class="footer__list">
                <li><a href="#">Sobre nosotros</a></li>
            </ul>
        </div>

        <div class="footer__col">
            <h3 class="footer__title">Legal</h3>
            <ul class="footer__list">
                <li><a href="#">Política de privacidad</a></li>
                <li><a href="#">Política de cookies</a></li>
                <li><a href="#">Términos y condiciones</a></li>
            </ul>
        </div>

    </div>

    <div class="footer__bottom">
        <div class="wrap footer__bottomGrid">
            <span>© 2026 Futiverso. Todos los derechos reservados.</span>

            <div class="footer__trust">
                <span>Pago seguro</span>
                <span class="footer__dot">•</span>
                <i class="fa-brands fa-cc-visa"></i>
                <i class="fa-brands fa-cc-mastercard"></i>
                <i class="fa-brands fa-cc-paypal"></i>
                <i class="fa-brands fa-apple-pay"></i>
            </div>
        </div>
    </div>
</footer>