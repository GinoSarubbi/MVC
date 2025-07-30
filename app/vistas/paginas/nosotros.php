<style>
    #about-hero {
        padding: 4rem 0;
        text-align: center;
    }

    #about-hero h1 {
        font-size: 2.5rem;
    }

    .card-value {
        border: none;
        transition: transform .3s, box-shadow .3s;
    }

    .card-value:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .1);
    }

    .team-card img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        transition: transform .3s;
    }

    .team-card:hover img {
        transform: scale(1.1);
    }


</style>

<div class="container vh-100 d-flex align-items-center justify-content-center">
    <section class="w-100">


        <div id="about-hero">
            <h1 class="text-dark fw-bold">Nosotros</h1>
            <p class="text-muted lead">Conoce más sobre nuestro equipo y misión</p>
        </div>


        <div class="row gx-4 gy-4 mb-5">
            <div class="col-md-4">
                <div class="card card-value h-100 text-center p-4">
                    <i class="bi bi-shield-lock-fill fs-1 text-primary mb-3"></i>
                    <h5 class="fw-bold">Seguridad</h5>
                    <p class="text-secondary">Aplicamos estándares de encriptación y mejores prácticas para que tu información esté siempre protegida.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-value h-100 text-center p-4">
                    <i class="bi bi-phone-fill fs-1 text-success mb-3"></i>
                    <h5 class="fw-bold">Usabilidad</h5>
                    <p class="text-secondary">Interfaz intuitiva y responsiva, accesible desde cualquier dispositivo.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-value h-100 text-center p-4">
                    <i class="bi bi-gear-fill fs-1 text-danger mb-3"></i>
                    <h5 class="fw-bold">Escalabilidad</h5>
                    <p class="text-secondary">Nuestra arquitectura crece contigo: módulos y APIs para integrar nuevas funcionalidades fácilmente.</p>
                </div>
            </div>
        </div>


        <div class="text-secondary mb-5">
            <p>Somos <strong>UserManager</strong>, un equipo de desarrolladores web apasionados por crear soluciones seguras, intuitivas y escalables. Nuestra misión es brindarte una plataforma fiable donde puedas registrarte, iniciar sesión y mantener tu perfil siempre al día.</p>
            <p>Utilizamos <em>PHP</em>, <em>MySQL</em> y <em>Bootstrap</em> para ofrecer un rendimiento óptimo en cualquier dispositivo. Trabajamos cada día para mejorar la experiencia de usuario: añadimos nuevas funcionalidades, corregimos errores y escuchamos tus sugerencias. ¡Gracias por confiar en nosotros!</p>
        </div>

        <div class="text-center">
            <a href="?ruta=registro" class="btn btn-primary px-4 me-2">Regístrate</a>
            <a href="?ruta=ingreso" class="btn btn-outline-primary px-4">Iniciar Sesión</a>
        </div>

    </section>
</div>