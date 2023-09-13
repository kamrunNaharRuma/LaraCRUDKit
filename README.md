# LaraCRUDKit
The package will perform the following actions:

1. Generate a migration file with the specified name.
2. Create a model for the given model name and fillable properties using model stub.
3. Generate a controller with CRUD function with form validation request using controller stub.
4. Create views for index, create, edit, and show files.
5. Add resource route for CRUD operations in the routes file.
6. Generate form validation request class for each model class.

# Usage
Once you have configured the package in your composer.json and app.php file, you can use it. Here's how you can do it in your project:

```$createCrud = new CrudKit();```

```$createCrud->generateAllComponents("Class", ["department","section", "no_of_students"]); ```

Replace "Class" with the name of your model (e.g., User, Product, etc.) and provide an array of field names (e.g., ["department","section", "no_of_students"]) that you want to include.


# Configuration
open your laravel project

1. in your composer.json file add     
"require": {
        "ruma/crud-kit": "dev-main"
    },
  "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/kamrunNaharRuma/LaraCRUDKit.git"
        }
    ]

2. now run composer require ruma/crud-kit:dev-main

3. after successfull installation of the project , it is time to test. before excutation don't forget to add 
    'providers' => [ Ruma\CrudKit\CrudKitServiceProvider::class,] and 
     'aliases' => [ 'CrudKit' => Ruma\CrudKit\CrudKit::class] in app.php file


