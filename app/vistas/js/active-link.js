document.addEventListener("DOMContentLoaded", function() {
    const links = document.querySelectorAll("#sidebarMenuDesktop .nav-link");

    links.forEach(link => {
        link.addEventListener("click", function() {
            // Eliminar la clase 'active' de todos los enlaces
            links.forEach(l => l.classList.remove("active"));
            this.classList.add("active");
        });
    });

    const ventanaActual = window.location.href;
    links.forEach(link => {
        if (link.href === ventanaActual) {
            links.forEach(l => l.classList.remove("active"));
            link.classList.add("active");
        }
    });
});