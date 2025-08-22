# UserManager — Mini‑proyecto MVC en PHP

> Sistema de administración (CRUD) de usuarios construido con **PHP Orientado a Objetos**, **MVC**, **PDO (MySQL)** y **Bootstrap 5**. Incluye estructura de rutas simple via `index.php?ruta=...`, componentes compartidos (header/sidebar) y endpoints AJAX para validaciones.

---

## 🧠 Lógica del proyecto

### Patrón MVC aplicado

* **Modelo**: encapsula el acceso a datos (PDO) y la lógica de negocio mínima.
* **Vista**: archivos PHP que renderizan HTML (Bootstrap 5). Se organizan por página/estado en `app/vistas/paginas/` y un **layout** principal `app/vistas/plantilla.php`.
* **Controlador**: interpreta la ruta (`?ruta=`), valida datos, invoca modelos y decide qué vista cargar.

### Enrutamiento (Front‑Controller)

* **`index.php`** actúa como *router* leyendo el parámetro `ruta`.
* Las rutas válidas coinciden con páginas dentro de `app/vistas/paginas/` (p. ej. `inicio`, `ingreso`, `registro`, `productos`, `nosotros`).
* Si la ruta no existe, se muestra `error404`.

### Componentes compartidos

* **Header** y **Sidebar** viven en `app/components/` y son incluidos por `plantilla.php`. Esto promueve **reutilización** y **consistencia visual**.

### Validaciones y AJAX

* Ejemplo: verificación de email único durante el registro.

  * **Endpoint**: `app/ajax/formularios.ajax.php` (recibe `POST validarEmail`).
  * **Controlador**: `app/controladores/formularios.controlador.php` expone el método que consulta el modelo.
  * **Vista/JS**: `app/vistas/js/` contiene los scripts que hacen `fetch` al endpoint y muestran alertas.

### Eliminación con confirmación (sin JS)

* La operación **DELETE** se confirma con una **vista intermedia** (server‑side) para evitar dependencias de JavaScript.

### Manejo de errores y logs

* Los avisos se registran en `logs/warnings.log` (no versionado recomendado). Puedes ajustar el *error reporting* en `app/config/errors.php` (o ubicación equivalente en tu setup).

---

## 🧰 Herramientas utilizadas

* **PHP ≥ 7.4** (OOP)
* **PDO (MySQL)** con *prepared statements* para evitar SQL Injection
* **Bootstrap 5** para UI responsiva
* **Bootstrap Icons** para iconografía (`bi bi-...`)
* **JavaScript** (fetch API) para validaciones en cliente
* **Git** para control de versiones

> Demo (opcional): `https://mvc.wuaze.com/index.php?ruta=nosotros`

---

## 📁 Estructura del repositorio

```text
php/
├─ index.php                     # Front‑controller / Router principal
├─ README.md                     # Este documento
├─ app/
│  ├─ config/
│  │  └─ errors.php              # Configuración de errores (display/logging)
│  ├─ components/
│  │  ├─ header.php
│  │  └─ sidebar.php
│  ├─ controladores/
│  │  ├─ formularios.controlador.php
│  │  └─ plantilla.controlador.php
│  ├─ modelos/
│  │  ├─ conexion.php            # Conexión PDO a MySQL
│  │  ├─ formularios.modelo.php
│  │  └─ usuario.php             # Lógica de usuarios (CRUD)
│  ├─ vistas/
│  │  ├─ plantilla.php           # Layout principal
│  │  ├─ paginas/
│  │  │  ├─ inicio.php
│  │  │  ├─ ingreso.php
│  │  │  ├─ registro.php
│  │  │  ├─ productos.php
│  │  │  ├─ nosotros.php
│  │  │  └─ error404.php
│  │  └─ js/
│  │     ├─ script.js            # Validaciones, eventos UI
│  │     └─ (otros)
│  └─ ajax/
│     └─ formularios.ajax.php    # Endpoints AJAX (p. ej., validar email)
├─ assets/
│  ├─ css/
│  │  ├─ styles.css
│  │  └─ styles_dos.css
│  └─ img/
│     ├─ 404.png
│     └─ error.png
└─ logs/
   └─ warnings.log               # (Ignorar en Git)
```

> Nota: si tu conexión PDO está en otra ruta (p. ej., `app/config/conexion.php`), ajusta este README y el *include* del proyecto.

---

## ⚙️ Instalación

1. Clona o copia el proyecto dentro de tu servidor local (XAMPP/MAMP/Laragon):

   ```bash
   git clone <url-del-repo>
   ```
2. Crea la base de datos y tablas requeridas (ver *SQL de ejemplo* abajo).
3. Configura credenciales en `app/modelos/conexion.php` (host, dbname, user, pass, charset) y confirma que la extensión **PDO MySQL** esté habilitada.
4. Levanta Apache/MySQL y navega a:

   * `http://localhost/curso/php/index.php`

---

## 🗂️ Base de datos (SQL de ejemplo)

### Tabla `usuarios`

```sql
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  creado_en DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### (Opcional) Tabla `productos`

```sql
CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  categoria_id INT NULL,
  costo DECIMAL(12,2) DEFAULT 0,
  precio DECIMAL(12,2) NOT NULL,
  stock INT DEFAULT 0,
  stock_minimo INT DEFAULT 0,
  estado ENUM('activo','inactivo') DEFAULT 'activo',
  descripcion TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

---

## 🔄 Flujo principal

1. **Ingreso** (`ingreso.php`): formulario de login simple (ejemplo educativo).
2. **Registro** (`registro.php`): formulario con validación de email único vía AJAX.
3. **Inicio/Tablero** (`inicio.php`): muestra tarjetas/estadísticas.
4. **Productos** (`productos.php`): ejemplo de listado con tabla responsiva.
5. **Nosotros** (`nosotros.php`): página informativa.

---

## 🔐 Seguridad (básicos)

* **Prepared statements** (PDO) para todas las operaciones SQL.
* Almacenar contraseñas con `password_hash()` / `password_verify()` (recomendado).
* Sanitizar salida en vistas (p. ej., `htmlspecialchars`).

---

## 🧪 Endpoint AJAX — ejemplo (validar email)

**Cliente (`app/vistas/js/script.js`)**

```js
const emailInput = document.getElementById('email');
if (emailInput) {
  emailInput.addEventListener('change', async () => {
    // limpiar alertas previas
    document.querySelectorAll('.alert').forEach(a => a.remove());

    const datos = new FormData();
    datos.append('validarEmail', emailInput.value);

    const res = await fetch('app/ajax/formularios.ajax.php', { method: 'POST', body: datos });
    const existe = await res.json();

    if (existe) {
      const alerta = document.createElement('div');
      alerta.className = 'alert alert-danger mt-2';
      alerta.textContent = 'El email ya está registrado';
      emailInput.insertAdjacentElement('afterend', alerta);
      emailInput.value = '';
      emailInput.focus();
    }
  });
}
```

**Servidor (`app/ajax/formularios.ajax.php`)**

```php
require_once '../controladores/formularios.controlador.php';
require_once '../modelos/formularios.modelo.php';

class AjaxRegistro {
  public $validarEmail;
  public function ajaxValidarEmail() {
    $item = 'email';
    $valor = $this->validarEmail;
    $respuesta = ControladorFormularios::ctrSeleccionarRegistros($item, $valor);
    echo json_encode($respuesta);
  }
}

if (isset($_POST['validarEmail'])) {
  $val = new AjaxRegistro();
  $val->validarEmail = $_POST['validarEmail'];
  $val->ajaxValidarEmail();
}
```

---

## 🪵 Logs y `.gitignore`

Ignorá los logs para que no contaminen el historial de Git:

```gitignore
logs/*.log
logs/
```

> Si ya fue versionado, podés sacarlo del índice: `git rm --cached logs/warnings.log` y luego *commit*.

---

## 🧭 Roadmap sugerido

* [ ] **UPDATE** de usuario (formulario y controlador dedicados)
* [ ] **Paginación** y **búsquedas** en listados (servidor)
* [ ] **Protección de rutas** / middleware simple (sesiones)
* [ ] **Mensajería de errores**/éxitos consistente (Flash messages)
* [ ] **Tests** (unitarios básicos de modelos)

---

## 🧰 Tips de entorno (Windows/CRLF)

Si ves advertencias de fin de línea (LF/CRLF), podés configurar Git:

```bash
git config core.autocrlf true   # o input, según tu flujo
```

---

## 📜 Licencia

Uso educativo y referencial. Podés adaptarlo libremente mencionando la autoría.

---

## 👤 Autor

**Gino Sarubbi** — Portafolio: *ginosarubbi.com*
