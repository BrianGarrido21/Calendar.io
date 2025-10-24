# 📅 Calendar.io

![Estado del Proyecto](https://img.shields.io/badge/status-en_desarrollo-yellowgreen)
![GitHub language count](https://img.shields.io/github/languages/count/BrianGarrido21/Calendar.io)
![GitHub top language](https://img.shields.io/github/languages/top/BrianGarrido21/Calendar.io?color=F05032)

Un clon funcional de Google Calendar construido como una aplicación web Full-Stack con el stack TALL (Tailwind, Alpine.js, Laravel, Livewire). Permite a los usuarios registrarse, iniciar sesión y gestionar sus eventos personales.



## ✨ Características Principales

* **Autenticación de Usuarios:** Sistema completo de registro e inicio de sesión (probablemente usando Laravel Breeze o Jetstream).
* **Gestión de Eventos (CRUD):** Los usuarios pueden crear, ver, actualizar y eliminar eventos en su calendario.
* **Componentes Reactivos:** Interfaz de usuario dinámica construida con Livewire, eliminando la necesidad de escribir JavaScript complejo.
* **Diseño Responsivo:** Interfaz adaptable a dispositivos móviles y de escritorio gracias a Tailwind CSS.
* **Vistas de Calendario:** Navegación fluida entre diferentes vistas (Mes, Semana, Día).
  
<img width="1317" height="793" alt="Screenshot 2025-10-24 at 08 55 04" src="https://github.com/user-attachments/assets/fe7e55ba-0fe4-45da-b642-bb26d0c053a1" />

---

## 🛠️ Tecnologías Utilizadas

Este proyecto está construido con una arquitectura basada en Laravel.

### **Backend (Servidor)**

* **[Laravel](https://laravel.com/)**: Framework de PHP para el desarrollo de la API REST y la lógica de negocio.
* **[Livewire](https://laravel-livewire.com/)**: Framework full-stack para construir interfaces dinámicas directamente en PHP/Blade.
* **[PHP](https://www.php.net/)**: Lenguaje de programación del lado del servidor.
* **[MySQL](https://www.mysql.com/)**: Base de datos relacional para almacenar usuarios y eventos.
* **Autenticación:** (Menciona si usas Laravel Breeze, Jetstream o Sanctum).

### **Frontend (Cliente)**

* **[Tailwind CSS](https://tailwindcss.com/)**: Framework de CSS utility-first para un diseño rápido y moderno.
* **[Alpine.js](https://alpinejs.dev/)**: Framework de JavaScript minimalista para pequeñas interacciones (incluido con Livewire/Jetstream).
* **[Blade](https://laravel.com/docs/blade)**: Motor de plantillas de Laravel.

---

## 🚀 Puesta en Marcha y Ejecución Local

Sigue estos pasos para obtener una copia local del proyecto y ponerla en funcionamiento.

### Prerrequisitos

* PHP (v8.1 o superior)
* Composer
* Node.js y npm (o yarn)
* Una base de datos (ej. MySQL)

### Guía de Instalación

1.  **Clona el repositorio:**
    ```bash
    git clone [https://github.com/BrianGarrido21/Calendar.io.git](https://github.com/BrianGarrido21/Calendar.io.git)
    cd Calendar.io
    ```

2.  **Instala dependencias de PHP:**
    ```bash
    composer install
    ```

3.  **Instala dependencias de Node.js:**
    ```bash
    npm install
    ```

4.  **Configura tu entorno:**
    * Copia el archivo de entorno de ejemplo y configúralo.
    ```bash
    cp .env.example .env
    ```
    * Genera la clave de la aplicación:
    ```bash
    php artisan key:generate
    ```

5.  **Configura tu base de datos:**
    * Abre el archivo `.env` y añade los datos de tu base de datos (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

6.  **Ejecuta las migraciones:**
    * Esto creará las tablas de usuarios y eventos en tu base de datos.
    ```bash
    php artisan migrate
    ```

### Ejecución del Proyecto

1.  **Inicia el servidor de desarrollo de Vite (para CSS/JS):**
    ```bash
    npm run dev
    ```

2.  **Inicia el servidor de Laravel (en otra terminal):**
    ```bash
    php artisan serve
    ```

* La aplicación estará disponible en `http://localhost:8000` (o el puerto que indique `artisan serve`).

---

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo `LICENSE` para más detalles.

---

## 👤 Contacto

**Brian Garrido Picón**

* GitHub: [@BrianGarrido21](https://github.com/BrianGarrido21)
* LinkedIn: [https://www.linkedin.com/in/brian-garrido-picón-6a0b65217/](https://www.linkedin.com/in/brian-garrido-picón-6a0b65217/)
