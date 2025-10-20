# 📅 Calendar.io

![Estado del Proyecto](https://img.shields.io/badge/status-en_desarrollo-yellowgreen)
![GitHub language count](https://img.shields.io/github/languages/count/BrianGarrido21/Calendar.io)
![GitHub top language](https://img.shields.io/github/languages/top/BrianGarrido21/Calendar.io)

Un clon funcional de Google Calendar construido como una aplicación web Full-Stack, permitiendo a los usuarios registrarse, iniciar sesión y gestionar sus eventos personales.

![[Añade aquí una captura de pantalla de tu proyecto]](https://via.placeholder.com/800x400.png?text=Captura+de+pantalla+de+Calendar.io)

## ✨ Características Principales

* **Autenticación de Usuarios:** Sistema completo de registro e inicio de sesión usando JWT (JSON Web Tokens).
* **Gestión de Eventos (CRUD):** Los usuarios pueden crear, ver, actualizar y eliminar eventos en su calendario.
* **Vistas de Calendario:** Navegación fluida entre vistas de Mes, Semana y Día.
* **Diseño Responsivo:** Interfaz adaptable a dispositivos móviles y de escritorio.
* **Eventos "Todo el día":** Opción para marcar eventos que duran todo el día.
* **[Añade otra característica]:** (Ej: Notificaciones por email, integración con Google, etc.)

---

## 🛠️ Tecnologías Utilizadas

Este proyecto utiliza una arquitectura MERN.

### **Frontend**

* **[React.js](https://reactjs.org/)** (v18+)
* **[React Router](https://reactrouter.com/)**: Para la navegación del lado del cliente.
* **[React Big Calendar](http://jquense.github.io/react-big-calendar/)**: Librería principal para la visualización del calendario.
* **[Axios](https://axios-http.com/)**: Para realizar peticiones HTTP al backend.
* **[Sass / CSS Modules](https://sass-lang.com/)**: Para estilos avanzados y componentizados.

### **Backend**

* **[Node.js](https://nodejs.org/)**: Entorno de ejecución para el servidor.
* **[Express.js](https://expressjs.com/)**: Framework para la construcción de la API REST.
* **[MongoDB](https://www.mongodb.com/)**: Base de datos NoSQL para almacenar usuarios y eventos.
* **[Mongoose](https://mongoosejs.com/)**: ODM para modelar los datos de MongoDB.
* **[JSON Web Token (JWT)](https://jwt.io/)**: Para la autenticación y protección de rutas.
* **[bcrypt.js](https://www.npmjs.com/package/bcrypt)**: Para el hasheo de contraseñas.

---

## 🚀 Puesta en Marcha y Ejecución Local

Sigue estos pasos para obtener una copia local del proyecto y ponerla en funcionamiento.

### Prerrequisitos

* Node.js (v16 o superior)
* npm (o yarn)
* MongoDB (una instancia local o un cluster en [MongoDB Atlas](https://www.mongodb.com/cloud/atlas))

### Guía de Instalación

1.  **Clona el repositorio:**
    ```bash
    git clone [https://github.com/BrianGarrido21/Calendar.io.git](https://github.com/BrianGarrido21/Calendar.io.git)
    cd Calendar.io
    ```

2.  **Instala las dependencias del Backend:**
    * (Asumiendo que tienes una carpeta `server` o `backend`)
    ```bash
    cd server
    npm install
    ```

3.  **Instala las dependencias del Frontend:**
    * (Asumiendo que tienes una carpeta `client` o `frontend`)
    ```bash
    cd ../client
    npm install
    ```

4.  **Configura las Variables de Entorno:**
    * Crea un archivo `.env` en la carpeta `server` (o en la raíz del backend).
    * Añade las siguientes variables (reemplaza con tus propios valores):
    ```env
    # Puerto del servidor
    PORT=5000

    # Tu string de conexión a MongoDB
    MONGO_URI=mongodb+srv://<usuario>:<password>@cluster.mongodb.net/calendarDB?retryWrites=true&w=majority

    # Una clave secreta para firmar los JWT
    JWT_SECRET=tu_clave_secreta_muy_larga_y_segura
    ```

### Ejecución del Proyecto

1.  **Inicia el Servidor (Backend):**
    * Desde la carpeta `server`:
    ```bash
    npm run dev  # O 'npm start', revisa tu package.json
    ```
    * El servidor debería estar corriendo en `http://localhost:5000`

2.  **Inicia el Cliente (Frontend):**
    * Desde la carpeta `client`:
    ```bash
    npm start
    ```
    * La aplicación se abrirá automáticamente en `http://localhost:3000`

---

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo `LICENSE` para más detalles.

---

## 👤 Contacto

**Brian Garrido**

* GitHub: [@BrianGarrido21](https://github.com/BrianGarrido21)
* LinkedIn: [Tu Perfil de LinkedIn]
