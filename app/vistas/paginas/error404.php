<style>
    body {
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background: #f8f9fa;
     
    }

    .error-container {
        text-align: center;
        padding: 2rem;
    }

    .error-container h1 {
        font-size: clamp(3rem, 10vw, 6rem);
        font-weight: 300;
        margin-bottom: 0.5rem;
        color: #343a40;
    }

    .error-container p {
        font-size: 1.25rem;
        color: #6c757d;
        margin-bottom: 1.5rem;
    }

    .error-container .btn {
        padding: 0.6rem 1.5rem;
        font-size: 1rem;
    }
</style>
<div class="error-container">
    <i class="bi bi-emoji-frown-fill error-icon text-danger fs-1"></i>
    <h1>404</h1>
    <p>La página que buscas no existe.</p>
    <a href="index.php?ruta=inicio" class="btn btn-outline-danger">Volver al inicio</a>
</div>