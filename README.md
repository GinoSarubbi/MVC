# Mini-proyecto **UserManager** con MVC en PHP

> Ejemplo práctico de un sistema CRUD de usuarios implementado con PHP OOP, MVC y Bootstrap 5.

---

## 📋 ¿Qué encontrarás aquí?

* Implementación del patrón **Modelo-Vista-Controlador (MVC)** en PHP orientado a objetos.
* Gestión de usuarios con **CRUD** (Crear, Leer, Eliminar) sobre una base de datos MySQL a través de **PDO**.
* **Responsive UI** con **Bootstrap 5**: sidebar colapsable (offcanvas), cards de métricas y tabla desplazable en mobile.
* Confirmación de eliminación **solo con PHP** (vista intermedia), sin depender de JavaScript.

---

## 📂 Estructura del repositorio

```text
php/
├── .gitignore
├── index.php                 # Front-controller / Router principal
├── README.md                 # Documentación de este proyecto
├── .git/                     # Control de versiones
├── app/                      # Lógica MVC
│   ├── config/
│   │   └── errors.php        # Manejo de errores personalizado
│   ├── controladores/        # Controladores MVC
│   │   ├── formularios.controlador.php
│   │   └── plantilla.controlador.php
│   ├── modelos/              # Modelos (acceso a datos)
│   │   ├── conexion.php      # Conexión PDO a MySQL
│   │   ├── formularios.modelo.php
│   │   └── usuario.php       # Lógica de eliminación de usuarios
│   └── vistas/               # Vistas y plantillas
│       ├── plantilla.php     # Layout principal (header, sidebar)
│       └── paginas/          # Vistas parciales de cada ruta
│           ├── error404.php
│           ├── ingreso.php
│           ├── inicio.php
│           ├── nosotros.php
│           └── registro.php
├── assets/                   # Recursos estáticos
│   ├── css/
│   │   ├── styles.css
│   │   └── styles_dos.css
│   └── img/
│       ├── 404.png
│       └── error.png
└── logs/                     # Archivos de log
    └── warning.log
```

---

## 🚀 Instalación y puesta en marcha

1. Clona o descarga el proyecto en tu servidor local (XAMPP, Laragon, MAMP).
2. Ajusta las credenciales de la BD en `app/modelos/conexion.php`.
3. Asegúrate de tener PHP ≥ 7.4 con la extensión PDO\_MySQL habilitada.
4. Accede en el navegador a `http://localhost/php/index.php`.

> Si tu carpeta raíz no es `php`, ajusta la URL según corresponda.

---

## 🔄 Flujo MVC y CRUD

1. **Front-controller**: `index.php` lee `?ruta=` y despacha al controlador.
2. **Controlador** (`app/controladores/…`): valida parámetros, carga vistas o ejecuta modelo.
3. **Modelo** (`app/modelos/Usuario.php`): encapsula la lógica de acceso a datos (DELETE).
4. **Vistas**:

   * **Layouts**: `app/vistas/plantilla.php` incluye header, sidebar y secciones de contenido.
   * **Páginas**: en `app/vistas/paginas/` cada archivo maneja un estado (inicio, registro, etc.).
   * **ConfirmDelete**: vista intermedia para confirmar eliminación vía POST.

---

## 🔧 Puntos clave y buenas prácticas

* **PDO** y **prepared statements** para prevenir SQL Injection.
* **MVC** separa responsabilidades: facilitando mantenimiento y escalabilidad.
* **Bootstrap 5 Offcanvas** para un sidebar responsivo y **.table-responsive** para tablas con scroll en móviles.
* **Confirmación sin JavaScript**: flujos de POST para confirmDelete.

---

## 🛠️ Retos y siguientes pasos

1. **Agregar actualización (UPDATE)** de usuario con vista y controlador dedicados.
2. **Implementar autenticación**: login/logout, middleware de sesión.
3. **Añadir validaciones** de formularios en el modelo o un servicio aparte.
4. **Paginación** en la tabla de usuarios.

---

## 📜 Licencia

Uso educativo y referencial. Puedes modificarlo y adaptarlo citando la fuente.
