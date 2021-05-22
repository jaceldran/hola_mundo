# holamundo

Aplicación Laravel + Vue.

## Pasos de instalación

1. Clonar o descargar y extraer el repositorio.

2. Abrir una terminal y entrar a la carpeta `holamundo`.

3. Ejecutar los siguientes comandos en la terminal:

    ```
    composer update

    npm install

    npm run dev
    ```

## Configuración de entorno

Renombrar el archivo `.env.example` a `.env`, o copiarlo y ajustar según preferencias.

## Configuración de correo

Configurar el driver de correo según preferencias. En este desarrollo se ha optado por usar mailtrap.

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=username en mailtrap
MAIL_PASSWORD=password en mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hello@world.com
MAIL_FROM_NAME="${APP_NAME}"
```

## Configuración de base de datos

Para probar en local se puede usar el driver **sqlite**. Para ello crear un archivo vacío en la carpeta `database` llamado `database.sqlite` y configurar las líneas correspondientes en el archivo `.env`

```
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Una vez configurada la base de datos, efecutar las migraciones con los seeders

```
php artisan:migrate --seed
```

## Ejecución

Levantar servidor local de desarrollo.

```
php artisan serve
```

Acceder a la url http://localhost:8000 o http://127.0.0.1:8000

## Capturas de la aplicación

### Home

![Alt](./home.png "Home")

### Formulario de contacto

![Alt](./contact_form.png "Formulario de contacto")

### Gestor de solicitudes

![Alt](./manage_view.png "Gestor de solicitudes")

### Gestor de solicitudes, ordenar por cualquier columna en sentido ascedente y descendente

![Alt](./manage_view_sort.png "Gestor de solicitudes")

### Gestor de solicitudes, filtrar por búsqueda

La búsqueda se lanza automáticamente al alcanzar 3 caracteres.

![Alt](./manage_view_sort.png "Gestor de solicitudes")

### Bandeja de entrada de Mailtrap

El correo de notificación incluye un renderizado simple de todos los datos del formulario y un anexo en PDF con el mismo contenido.

![Alt](./mailtrap_inbox.png "Bandeja de entrada de Mailtrap")

### Visor y descarga del PDF

Al pulsar el botón de descarga de PDF, si el archivo existe se sirve en línea. En caso contrario se compone usando el mismo método que al enviar la notificación.

![Alt](./download_pdf.png "Visor y descarga del PDF")

```

```
