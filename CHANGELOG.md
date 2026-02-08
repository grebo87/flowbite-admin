# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.0.0] - 2026-02-07

### Added

- **Layout principal** (`layouts.app`) con soporte para dark mode
- **Navbar dinámico** que lee configuración:
  - Logo y nombre de la aplicación personalizables
  - Menú de usuario configurable
  - Toggle de dark/light mode
  - Muestra datos del usuario autenticado
- **Sidebar dinámico** con items configurables:
  - 9 iconos disponibles: `dashboard`, `kanban`, `inbox`, `users`, `products`, `signin`, `signup`, `settings`, `home`
  - Badges con 5 colores: `blue`, `gray`, `red`, `green`, `yellow`
  - Active state automático basado en la ruta actual
- **Componentes Blade**:
  - `card` - Tarjeta con título y footer opcionales
  - `table` - Tabla responsiva con headers dinámicos
  - `chart` - Wrapper para ApexCharts con soporte dark mode
  - `form.input` - Input con label, validación y estados de error
  - `form.select` - Select con opciones dinámicas
  - `form.button` - Botón con variantes (primary, secondary, danger, success, warning)
- **Comando de instalación** (`flowbite-admin:install`):
  - Configura `package.json` con dependencias de Flowbite
  - Actualiza `tailwind.config.js`
  - Configura `app.css` y `app.js`
- **Configuración publicable** (`config/flowbite-admin.php`):
  - `app_name` - Nombre de la aplicación
  - `logo` - URL del logo
  - `sidebar` - Items del menú lateral
  - `user_menu` - Items del menú de usuario
  - `logout_route` - Ruta de logout
- **Vistas publicables** para personalización completa
- **Tests con PHPUnit** y Orchestra Testbench

### Supported Versions

- PHP 8.2+
- Laravel 10.x, 11.x, 12.x

---

## How to Update

```bash
composer update grebo87/flowbite-admin
```

After updating, you may need to republish the config if there are new options:

```bash
php artisan vendor:publish --tag=flowbite-admin-config --force
```
