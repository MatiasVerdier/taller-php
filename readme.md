# Taller PHP 2017

### Instrucciones

Clonar o descargar este repositorio

```bash
git clone https://github.com/MatiasVerdier/taller-php
```
Moverse a la carpeta creada

```bash
cd taller-php
```

Instalar dependencias con composer

```bash
composer install
```

Instalar dependencias npm

```bash
npm install
```

Crear archivo `.env` y copiar el contenido del archivo `env.example`

Editar la configuración para conectarse a la base de datos

```
# Ejemplo

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taller-php
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

Genera la clave para JWT (Json Web Tokens)

```bash
php artisan jwt:generate 
```
Este comando genera una clave en el archivo `.env` en la propiedad `JWT_SECRET`

Migrar la base de datos

```bash
php artisan migrate --seed
```

Ejecutar la aplicación en modo desarrollo

```bash
npm run hot
```

Navegar al host donde este corriendo el servidor php con la aplicación
