<?php

namespace Grebo87\FlowbiteAdmin\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    protected $signature = 'flowbite-admin:install';
    protected $description = 'Install the Flowbite Admin package resources';

    public function handle()
    {
        $this->info('Installing Flowbite Admin package...');

        // 1. Publish configuration
        $this->publishConfiguration();

        // 2. Update package.json
        $this->updateNodePackages(function ($packages) {
            return [
                'flowbite' => '^2.3.0',
                'apexcharts' => '^3.46.0',
                '@tailwindcss/forms' => '^0.5.7',
            ] + $packages;
        });

        // 3. Update tailwind.config.js
        $this->updateTailwindConfig();

        // 4. Update app.css
        $this->updateAppCss();

        // 5. Update app.js (for flowbite init)
        $this->updateAppJs();

        $this->info('Flowbite Admin installed successfully.');
        $this->comment('Please run "npm install && npm run build" to compile your assets.');
    }

    protected function publishConfiguration()
    {
        $this->call('vendor:publish', [
            '--provider' => 'Grebo87\FlowbiteAdmin\FlowbiteAdminServiceProvider',
            '--tag' => 'flowbite-admin-config',
        ]);
    }

    protected function updateNodePackages(callable $callback, $dev = true)
    {
        if (!file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';
        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
        );

        $this->info('Updated package.json');
    }

    protected function updateTailwindConfig()
    {
        $tailwindPath = base_path('tailwind.config.js');
        if (!file_exists($tailwindPath)) {
            // Copy the stub file from the package
            copy(__DIR__ . '/../../stubs/tailwind.config.js', $tailwindPath);
            $this->info('Created tailwind.config.js from package stub.');
            return;
        }

        $tailwindConfig = file_get_contents($tailwindPath);

        // 1. Add content paths
        $contentPaths = [
            "'./vendor/grebo87/flowbite-admin/resources/views/**/*.blade.php',",
            "'./node_modules/flowbite/**/*.js',",
        ];

        foreach ($contentPaths as $path) {
            if (!str_contains($tailwindConfig, str_replace("',", "", $path))) {
                $tailwindConfig = str_replace(
                    "content: [",
                    "content: [\n        {$path}",
                    $tailwindConfig
                );
            }
        }

        // 2. Add Flowbite Plugin
        if (!str_contains($tailwindConfig, "require('flowbite/plugin')") && !str_contains($tailwindConfig, 'require("flowbite/plugin")')) {
            if (str_contains($tailwindConfig, 'plugins: [')) {
                $tailwindConfig = str_replace(
                    'plugins: [',
                    "plugins: [\n        require('flowbite/plugin'),",
                    $tailwindConfig
                );
            } else {
                // Try to find the closing brace of the export default object
                $tailwindConfig = preg_replace('/}\s*$/', "    plugins: [\n        require('flowbite/plugin'),\n    ],\n}", $tailwindConfig);
            }
        }

        file_put_contents($tailwindPath, $tailwindConfig);
        $this->info('Updated tailwind.config.js');
    }

    protected function updateAppCss()
    {
        $cssPath = resource_path('css/app.css');
        if (file_exists($cssPath)) {
            $css = file_get_contents($cssPath);
            if (!str_contains($css, '@tailwind base')) {
                file_put_contents($cssPath, "@tailwind base;\n@tailwind components;\n@tailwind utilities;\n" . $css);
            }
        }
    }

    protected function updateAppJs()
    {
        $jsPath = resource_path('js/app.js');
        if (file_exists($jsPath)) {
            $js = file_get_contents($jsPath);
            if (!str_contains($js, "import 'flowbite';")) {
                file_put_contents($jsPath, "import 'flowbite';\n" . $js);
            }
        } else {
            // Create if not exists
            if (!is_dir(dirname($jsPath))) {
                mkdir(dirname($jsPath), 0755, true);
            }
            file_put_contents($jsPath, "import 'flowbite';\n");
        }
        $this->info('Updated app.js');
    }
}
