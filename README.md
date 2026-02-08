# Flowbite Admin for Laravel

[![PHP Version](https://img.shields.io/packagist/php-v/grebo87/flowbite-admin)](https://packagist.org/packages/grebo87/flowbite-admin)
[![Laravel Version](https://img.shields.io/badge/Laravel-10.x%20|%2011.x%20|%2012.x-red)](https://laravel.com)
[![License](https://img.shields.io/packagist/l/grebo87/flowbite-admin)](LICENSE)

A beautiful admin dashboard theme for Laravel using [Flowbite](https://flowbite.com/) components and Tailwind CSS.

## Features

- 🎨 **Modern UI** - Clean and professional admin interface
- 🌙 **Dark Mode** - Built-in dark mode support with toggle
- 📱 **Responsive** - Mobile-friendly sidebar and navigation
- 🧩 **Components** - Ready-to-use Blade components (cards, tables, forms, charts)
- ⚡ **Easy Setup** - One command installation

## Requirements

- PHP 8.2+
- Laravel 10.x, 11.x or 12.x
- Node.js & NPM

## Installation

### Step 1: Install the package

```bash
composer require grebo87/flowbite-admin
```

### Step 2: Run the installer

```bash
php artisan flowbite-admin:install
```

This command will:

- Add Flowbite dependencies to `package.json`
- Configure `tailwind.config.js`
- Update `app.css` and `app.js`

### Step 3: Build assets

```bash
npm install && npm run build
```

## Usage

### Using the Layout

Extend the admin layout in your Blade views:

```blade
@extends('flowbite-admin::layouts.app')

@section('content')
    <h1 class="text-2xl font-bold dark:text-white">Dashboard</h1>
    <!-- Your content here -->
@endsection
```

### Available Components

#### Card

```blade
<x-flowbite-admin::card title="Sales Overview">
    <p>Your card content here</p>
</x-flowbite-admin::card>
```

#### Table

```blade
<x-flowbite-admin::table :headers="['Name', 'Email', 'Role']">
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
        </tr>
    @endforeach
</x-flowbite-admin::table>
```

#### Form Components

```blade
<x-flowbite-admin::form.input
    name="email"
    label="Email"
    type="email"
    placeholder="Enter your email"
/>

<x-flowbite-admin::form.select
    name="role"
    label="Role"
    :options="['admin' => 'Admin', 'user' => 'User']"
/>

<x-flowbite-admin::form.button type="submit" variant="primary">
    Save
</x-flowbite-admin::form.button>
```

#### Chart (ApexCharts)

```blade
<x-flowbite-admin::chart
    id="sales-chart"
    type="area"
    :options="$chartOptions"
/>
```

## Customization

### Publishing Assets

Publish the views to customize them:

```bash
php artisan vendor:publish --tag=flowbite-admin-views
```

Publish the configuration:

```bash
php artisan vendor:publish --tag=flowbite-admin-config
```

### Configuration Options

After publishing, edit `config/flowbite-admin.php`:

```php
return [
    'app_name' => 'My Admin Panel',
    'logo' => '/images/logo.svg',

    'sidebar' => [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'chart-pie'],
        ['label' => 'Users', 'route' => 'users.index', 'icon' => 'users'],
    ],
];
```

## Stacks

The layout provides these Blade stacks for adding custom assets:

```blade
@push('styles')
    <link rel="stylesheet" href="/custom.css">
@endpush

@push('scripts')
    <script src="/custom.js"></script>
@endpush
```

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Author

- **grebo87** - [grebodeveloper@gmail.com](mailto:grebodeveloper@gmail.com)
