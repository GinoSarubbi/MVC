<<<<<<< HEAD
# README – Mini-proyecto **MVC** en PHP

> Material de acompañamiento para la clase

---

## 👀 ¿Qué vas a encontrar acá?

Este repositorio contiene un ejemplo **minimalista** pero funcional del patrón **Modelo-Vista-Controlador (MVC)** construido a mano con PHP orientado a objetos.
Su objetivo es que el grupo:

1. **Visualice** cómo se separan responsabilidades entre archivos.
2. **Navegue** el flujo completo de la petición HTTP hasta la respuesta HTML.
3. **Modifique** y amplíe la base para incluir modelos y lógica de negocio reales en las próximas clases.

## Recordatorio rápido: ¿qué es MVC?

| Módulo          | Rol en la app                                                           | Dónde lo vemos en este proyecto                                                  |
| --------------- | ----------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| **Modelo**      | Representa y gestiona los **datos** (validaciones, acceso a BD).        | *Se implementará en la siguiente práctica*.                                      |
| **Vista**       | Define la **interfaz** que ve el usuario (HTML + CSS).                  | `vistas/plantilla.php` (layout global) + archivos en `paginas/` (cada pantalla). |
| **Controlador** | Recibe la petición, **decide** qué hacer y **coordina** Modelo ↔ Vista. | `controladores/plantilla.controlador.php` (y futuros controladores).             |

> **Clave didáctica:** aunque hoy el Modelo real todavía no esté, ya reservamos su lugar en la arquitectura. Las tareas se reparten para no mezclar código de presentación con lógica de negocio.


## 📂 Estructura del repositorio

```text
proyecto-mvc/
│
├── index.php                      # Front-controller (punto de entrada)
│
├── controladores/
│   └── plantilla.controlador.php  # Controlador principal
│
├── vistas/
│   └── plantilla.php              # Vista maestra (layout + menú + router)
│
├── paginas/                       # Vistas parciales
│   ├── inicio.php
│   ├── registro.php
│   ├── ingreso.php
│   └── error404.php
│
└── css/
    └── estilos.css                # Estilos globales

```

### ¿Por qué así?

* **`index.php`** centraliza seguridad y configuración inicial.
* Cada carpeta corresponde a **una capa** del patrón MVC.
* Cuando sumemos un Modelo real (`modelos/Usuario.php`, por ejemplo) la estructura escalará sin romperse.



## 🚀 Cómo ejecutar la demo

1. **Clona** o descarga este directorio en tu servidor local (XAMPP, Laragon, MAMP).

2. Encendé Apache + PHP.

3. Abre tu navegador en

   http://localhost/proyecto-mvc/
   ```

4. Haz clic en los enlaces del menú y observa cómo cambia la URL con `?ruta=`.

   > Sugerencia: abre las DevTools, pestaña **Network**, y sigue la petición completa.



## 🔎 Guía de lectura del código

| Archivo                                   | Preguntas guía                                                                                                        |
| ----------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------- |
| `index.php`                               | *¿Por qué conviene tener un único punto de entrada?*<br>*¿Qué pasaría si expusiéramos cada vista directamente?*                             |
| `controladores/plantilla.controlador.php` | *¿Qué pasaría si aquí tuviéramos HTML?*<br>*¿Qué ventaja da envolver la carga de la plantilla en un método público?*                        |
| `vistas/plantilla.php`                    | Localiza el mini-router `if (isset($_GET['ruta'])) …`.<br>*¿Cómo podemos mejorar ese router para evitar repetir nombres?*                   |
| Archivos de `paginas/`                    | *¿Por qué no hay lógica de negocio dentro de estas vistas?*<br>*¿Qué función PHP usamos para imprimir seguro (hint: `htmlspecialchars()`)?* |
| `css/estilos.css`                         | *¿Dónde se vincula desde la vista maestra?*<br>*¿Qué capa del patrón representa?*                                                           |


## 🌟 Objetivos de aprendizaje de esta unidad

1. **Distinguir** claramente Controlador y Vista.
2. **Comprender** el flujo HTTP → front-controller → controlador → vista → navegador.
3. **Preparar** la incorporación de un Modelo real y un router más robusto.


## 🏆 Retos para practicar

1. **Agregar una ruta “Nosotros”**

   * Crear `paginas/nosotros.php`.
   * Actualizar menú + condicional del router.

2. **Mejorar el router**

   * Cambiar el bloque `if` por un `switch` o por un array de rutas válidas con `in_array()`.

3. **Diseñar el Modelo**

   * Esbozar la clase `Usuario` (atributos: nombre, email, password) sin BD; solo instancias en memoria.
   * Pensar: ¿dónde se crearía el objeto y quién lo llamaría?

*(Estos ejercicios se trabajarán en la próxima clase; quien quiera puede adelantarse).*

---

## 📚 Próximos pasos en el curso

| Clase | Tema central                                                            | Meta                                          |
| ----- | ----------------------------------------------------------------------- | --------------------------------------------- |
| 2     | Implementar **Modelo** con clase `Usuario` y validación de formularios. | Almacenar usuarios en sesión como “falsa BD”. |
| 3     | Conectar **MySQL + PDO**.                                               | Persistir usuarios reales.                    |
| 4     | Autenticación básica (login/logout, sesiones).                          | Flujo completo CRUD.                          |

---

## 🗄️ Conexión a Base de Datos con PDO

### ¿Qué es **PDO**?

**PDO (PHP Data Objects)** es una capa de abstracción de bases de datos incluida en PHP desde la versión 5.1.

* Permite conectarse a distintos motores (MySQL, PostgreSQL, SQLite, SQL Server, etc.) mediante **la misma API**.
* Expone un objeto `PDO` que gestiona la conexión y un objeto `PDOStatement` para ejecutar consultas.
* Soporta **prepared statements** (consultas preparadas) y **bound parameters**, reduciendo el riesgo de **SQL Injection**.
* Facilita el manejo de **transacciones** (`beginTransaction`, `commit`, `rollBack`) de forma uniforme.
* Centraliza el **manejo de errores** mediante excepciones (`PDOException`).

Al usar PDO, tu código se vuelve:

| Ventaja       | Impacto práctico                                                 |
| ------------- | ---------------------------------------------------------------- |
| Portabilidad  | Cambiar de motor implica modificar solo el DSN.                  |
| Seguridad     | Consultas parametrizadas → sin concatenar strings SQL.           |
| Mantenimiento | Una única clase `Conexion` evita duplicar lógica en cada modelo. |

---

El directorio `modelos/` ahora contiene un archivo **`conexion.php`** que centraliza la conexión a MySQL usando **PDO**.

```text
modelos/
└── conexion.php
```

<details>
<summary>🎯 Objetivo del archivo</summary>

* **Encapsular** los datos de acceso (DSN, usuario, contraseña).
* Exponer una **única instancia** de `PDO` para que el resto de los modelos no repitan código.
* Facilitar el cambio de motor (MySQL → PostgreSQL) modificando solo este punto.

</details>

<details>
<summary>📄 Código explicado</summary>

```php
<?php

class Conexion
{
    public function conectar()
    {
        $link = new PDO(
            "mysql:host=localhost;port=3306;dbname=php_avanzado_498",
            "root",
            ""
        );
        // Configura el juego de caracteres a UTF‑8
        $link->exec("set names utf8");

        return $link;
    }
}
```

* El método `conectar()` crea y devuelve **una nueva** instancia de `PDO` por cada llamada.
* `set names utf8` garantiza que todas las consultas usen el juego de caracteres UTF‑8.
* Si prefirieras mantener **una sola** conexión viva, podés adaptar el código al patrón *Singleton* (propiedad estática).

</details>

<details>
<summary>💡 Conceptos teóricos</summary>

| Concepto                  | ¿Por qué es importante?                                                        |
| ------------------------- | ------------------------------------------------------------------------------ |
| **PDO**                   | Abstracción de base de datos → un solo API para MySQL, PostgreSQL, SQLite…     |


</details>


\$1

* PHP ≥ 7.4
* Servidor Apache (XAMPP / Laragon / MAMP)
* Navegador moderno (Chrome, Firefox, Edge)

---

## 📜 Licencia y uso

Código liberado con fines **exclusivamente educativos**.
Puedes modificar, compartir y reutilizarlo dentro de tu curso o proyecto citando la fuente.

---
=======
# MVC
>>>>>>> a843b9cd4f9688f9e0032013aa586f689d2518c1
