# ERP System - FerreToolsApp

Este proyecto es un **sistema ERP** desarrollado con **PHP 8.3**, que sigue el patrón de diseño **Adapters** y está diseñado para ser modular y extensible. El sistema incluye módulos de gestión de clientes, productos, pedidos, facturación e inventario. El sistema está pensado para facilitar la gestión de las operaciones diarias en una ferretería o negocio similar, ofreciendo un panel administrativo y una estructura robusta para futuras expansiones.

## Características Principales

- **Módulos** de Ventas, Inventario, Facturación, Clientes, Pedidos.
- **Autenticación** con registro e inicio de sesión.
- **Roles de Usuario** para controlar el acceso a las diferentes secciones del sistema.
- **Rutas protegidas** que permiten controlar qué usuarios pueden acceder a cada módulo.
- **Sistema de manejo de errores** HTTP con respuestas claras y detalladas.
- **Diseño limpio y responsive** utilizando Bootstrap 5.
- **Manejo de formularios** con sanitización de datos para evitar ataques de inyección.

## Requisitos

- PHP >= 8.3
- Composer
- Servidor web (Apache, Nginx)
- MySQL (Puedes usar PostgreSQL, Oracle, SQL Server, etc)
- Extensiones PHP:
  - PDO
  - cURL
  - mbstring

## Librerías Utilizadas

El proyecto se construyó utilizando las siguientes librerías:

- **[Medoo](https://medoo.in/)**: ORM ligero para la interacción con la base de datos.
- **[PHPMailer](https://github.com/PHPMailer/PHPMailer)**: Para el envío de correos electrónicos.
- **[Monolog](https://github.com/Seldaek/monolog)**: Para el registro y manejo de logs.
- **[phpdotenv](https://github.com/vlucas/phpdotenv)**: Para la gestión de variables de entorno.
- **[AltoRouter](https://github.com/dannyvankooten/AltoRouter)**: Router simple y rápido para la gestión de rutas.
- **[Symfony HttpFoundation](https://github.com/symfony/http-foundation)**: Para manejar las peticiones y respuestas HTTP.

## Instalación

### 1. Clona el repositorio

```bash
git clone https://github.com/daviddevgt/proyecto-erp.git
cd proyecto-erp
```

### 2. Instala las dependencias de Composer

Asegúrate de que tienes Composer instalado. Luego, ejecuta el siguiente comando:

```bash
composer install
```

### 3. Configuración del entorno

Crea un archivo `.env` en la raíz del proyecto basado en el archivo `.env.example`. Actualiza las variables con la configuración de tu base de datos y otros ajustes:

```
DB_DRIVER=mysql
DB_HOST=127.0.0.1
DB_NAME=erp_database
DB_USER=root
DB_PASS=password
DB_CHARSET=utf8mb4
```

### 4. Configuración de la base de datos

Crea una base de datos para el sistema e importa el archivo `schema.sql` ubicado en la carpeta `schema`.

```bash
mysql -u root -p erp_database < schema/schema.sql
```

### 5. Iniciar el servidor

Puedes usar el servidor de desarrollo de PHP para correr la aplicación en local:

```bash
php -S localhost:8000 -t public
```

Luego, abre el navegador y ve a `http://localhost:8000`.

## Estructura del Proyecto

```plaintext
.
├── app
│   ├── Config         # Configuraciones del sistema, rutas y módulos
│   ├── Controllers    # Controladores del sistema
│   ├── Core           # Clases de core (ej. conexión a la base de datos)
│   ├── Entities       # Entidades que representan las tablas de la BD
│   ├── Repositories   # Repositorios para la gestión de entidades
│   └── Views          # Vistas y componentes de la aplicación
├── public
│   ├── assets         # Archivos estáticos (CSS, JS, imágenes)
│   └── index.php      # Punto de entrada del sistema
├── schema
│   └── schema.sql     # Esquema de la base de datos
└── vendor             # Dependencias instaladas por Composer
```

## Uso

### 1. Autenticación

El sistema cuenta con un sistema de **login y registro** para gestionar el acceso de usuarios. Los usuarios registrados pueden acceder a las diferentes secciones del ERP según el rol que se les haya asignado.

- **Roles soportados**:
  - `ADMIN`
  - `GERENCIA`
  - `VENTAS`
  - `BODEGA`
  - `INVITADO`

### 2. Módulos

El sistema está estructurado en módulos, los cuales pueden ser gestionados desde la interfaz de administración. Algunos de los módulos principales son:

- **Clientes**: Gestión de los datos de los clientes.
- **Pedidos**: Gestión y seguimiento de los pedidos.
- **Facturación**: Generación y gestión de facturas.
- **Productos**: Gestión del inventario de productos.

## Desarrollo

### 1. Agregar Nuevas Rutas

Las rutas del sistema están gestionadas a través de **AltoRouter**. Puedes añadir nuevas rutas editando el archivo `app/Config/Routes.php`. Asegúrate de mapear correctamente los controladores y métodos para cada ruta.

### 2. Estructura de las Vistas

Las vistas están organizadas en la carpeta `app/Views`. Si deseas agregar nuevas vistas, simplemente crea los archivos correspondientes en esta carpeta y asegúrate de referenciarlos correctamente en los controladores.
