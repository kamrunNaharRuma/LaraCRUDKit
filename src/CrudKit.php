<?php

namespace Ruma\CrudKit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CrudKit
{
    public function generateAllComponents(string $name, array $properties)
    {
        try {
            // Run Artisan commands to generate components
            $this->generateModel($name, $properties);
            $this->generateValidationRequest($name);
            $this->generateController($name);
            $this->generateMigration($name);
            $this->generateBasicView($name);
            $this->addRouteDefinition($name);

            return response()->json(['message' => 'All components generated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    private function generateModel(string $name, array $fillableProperties)
    {
        try {
            // Specify the path where you want to save the generated model
            $path = app_path('Models/' . $name . '.php');

            // Create the directory if it doesn't exist
            if (!File::isDirectory(dirname($path))) {
                File::makeDirectory(dirname($path), 0755, true);
            }

            // Get the content of the custom model stub
            $stub = File::get(__DIR__ . '/stubs/Model.stub');

            // Replace placeholders with actual values
            $stub = str_replace('{{Namespace}}', 'App\Models', $stub);
            $stub = str_replace('{{ModelName}}', $name, $stub);
            $stub = str_replace('{{FillableProperties}}', json_encode($fillableProperties), $stub);

            // Save the generated model
            File::put($path, $stub);

            return "Model generated successfully";
        } catch (\Exception $e) {
            return "Error generating model: " . $e->getMessage();
        }
    }

    private function generateMigration(string $name)
    {
        try {
            // Generate migration
            Artisan::call('make:migration', ['name' => 'create_' . strtolower($name) . 's_table']);
        } catch (\Exception $e) {
            throw new \Exception('Error generating migration: ' . $e->getMessage());
        }
    }

    private function generateValidationRequest(string $name)
    {
        try {
            // Generate validation request
            Artisan::call('make:request', ['name' => $name . 'Request']);
        } catch (\Exception $e) {
            throw new \Exception('Error generating validation request: ' . $e->getMessage());
        }
    }

    private function generateBasicView(string $name)
    {
        try {
            // Create a basic view directory
            $viewPath = resource_path('views/' . strtolower($name));
            if (!file_exists($viewPath)) {
                mkdir($viewPath, 0755, true);
            }

            // Generate a basic view file
            $viewFile = $viewPath . '/index.blade.php';
            if (!file_exists($viewFile)) {
                file_put_contents($viewFile, '<!-- ' . $name . ' Index View -->');
            }
            $viewFile = $viewPath . '/create.blade.php';
            if (!file_exists($viewFile)) {
                file_put_contents($viewFile, '<!-- ' . $name . ' Create View -->');
            }
            $viewFile = $viewPath . '/show.blade.php';
            if (!file_exists($viewFile)) {
                file_put_contents($viewFile, '<!-- ' . $name . ' Show View -->');
            }
            $viewFile = $viewPath . '/edit.blade.php';
            if (!file_exists($viewFile)) {
                file_put_contents($viewFile, '<!-- ' . $name . ' Edit View -->');
            }
        } catch (\Exception $e) {
            throw new \Exception('Error generating basic view: ' . $e->getMessage());
        }
    }

    private function addRouteDefinition(string $name)
    {
        try {
            // Add route definition
            $routeDefinition = "\nRoute::resource('" . strtolower($name) . "', " . $name . "Controller::class);";
            file_put_contents(base_path('routes/web.php'), $routeDefinition, FILE_APPEND);
        } catch (\Exception $e) {
            throw new \Exception('Error adding route definition: ' . $e->getMessage());
        }
    }


    public function generateController(string $name)
    {
        try {
            // Get the content of the custom stub
            $stub = File::get(__DIR__ . '/stubs/Controller.stub');

            // Replace placeholders with actual values
            $stub = str_replace('{{Namespace}}', 'App\Http\Controllers', $stub);
            $stub = str_replace('{{ControllerName}}', $name . 'Controller', $stub);
            $stub = str_replace('{{ValidationRequest}}', $name . 'Request', $stub);
            // Specify the path where you want to save the generated controller
            $path = app_path('Http/Controllers/' . $name . 'Controller.php');

            // Create the directory if it doesn't exist
            if (!File::isDirectory(dirname($path))) {
                File::makeDirectory(dirname($path), 0755, true);
            }

            // Save the generated controller
            File::put($path, $stub);

            return "Controller generated successfully";
        } catch (\Exception $e) {
            return "Error generating controller: " . $e->getMessage();
        }
    }
}