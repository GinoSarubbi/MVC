    document.querySelector('.contrasena-cambiar').addEventListener('click', function() {
        const pwd = document.getElementById('contrasena');
        const icon = document.getElementById('icon-password');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
        } else {
            pwd.type = 'password';
            icon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
        }
    });
