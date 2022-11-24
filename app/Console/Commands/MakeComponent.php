<?php

namespace App\Console\Commands;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * The make:component command will create a full-scale component for our
 * Inertia application. The view refers to the .vue Typescript file that
 * will be created within its corresponding layout directory.
 *
 * @author  Jason Napolitano
 * @licence MIT
 * @version 1.5.0
 * @package App\Console\Commands
 * ----------------------------------------------------------------------------
 * EXAMPLE:
 *
 * # let's generate a products component for the backend (CRUD)
 *
 * $ php artisan make:component Products backend
 *  -> Controller & Views (can be created separately):
 *    -> Controller: App\Http\Controllers\Backend\ProductsController::index()
 *    -> View:       resources/pages/backend/products/index.vue    [w/ props]
 *
 *    -> Controller: App\Http\Controllers\Backend\ProductsController::create()
 *    -> View:       resources/pages/backend/products/create.vue   [w/ form data]
 *
 *    -> Controller: App\Http\Controllers\Backend\ProductsController::edit()
 *    -> View:       resources/pages/backend/products/edit.vue     [w/ form data & props]
 *
 *    -> Controller: App\Http\Controllers\Backend\ProductsController::show()
 *    -> View:       resources/pages/backend/products/show.vue     [w/ props]
 *
 * The other subcomponents will adhere to the following convention:
 *  -> Requests:
 *    -> App\Http\Requests\Products\CreateProductRequest
 *    -> App\Http\Requests\Products\UpdateProductRequest
 *
 *  -> Model:
 *    -> App\Models\Product
 *
 *  -> Migration:
 *    -> database/create_products_table.php
 *
 *  -> Seeder:
 *    -> Database/Seeders/ProductSeeder
 *
 *  -> Factory:
 *    -> Database/Factories/ProductFactory
 *
 *  -> Test:
 *    -> Tests\Feature\Backend\ProductsTest
 */
class MakeComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string $signature
     */
    protected $signature = 'make:component
								{name : The name of the component [EG: Products]}
								{layout=frontend : The component layout to use [frontend|backend]}
								{--pages=true : Create frontend view pages?}
								{--requests=true : Create form requests?}
								{--test=true : Create a feature test?}
								{--controller=true : Create a controller?}
								{--migration=true : Create a migration?}
								{--factory=true : Create a factory?}
								{--seeder=true : Create a seeder?}
								{--model=true : Create a model?}
							';

    /**
     * The console command description.
     *
     * @var string $description
     */
    protected $description = '
		Creates a (potentially complete) component for our Inertia application.
		A full component includes a Controller, Model, Seeder, Factory, Requests,
		Migration, and all view files that are `props` and form data ready.
	';

    /**
     * Choose between frontend & backend
     *
     * @var bool|string $layoutName
     */
    private bool|string $layoutName;

    /**
     * What to name the component (EG: Products, Clients, Movies)
     *
     * @var bool|string $componentName
     */
    private bool|string $componentName;

    /**
     * Where are the VueJS stubs located that we need to copy?
     *
     * @var string $stubsPath
     */
    private string $stubsPath;

    /**
     * The path to the VueJS app
     *
     * [default: /resources/*]
     *
     * @var string $vuePath
     */
    private string $vuePath;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        // build the paths
        $this->buildPaths();

        // generate sub-components
        $this
            ->generateSubComponent('pages', fn () => $this->makeVueFiles())
            ->generateSubComponent('controller', fn () => $this->makeController())
            ->generateSubComponent('model', fn () => $this->makeModel())
            ->generateSubComponent('migration', fn () => $this->makeMigration())
            ->generateSubComponent('requests', fn () => $this->makeRequests())
            ->generateSubComponent('factory', fn () => $this->makeFactory())
            ->generateSubComponent('seeder', fn () => $this->makeSeeder())
            ->generateSubComponent('test', fn () => $this->makeTest());
    }

    /**
     * Build the paths
     *
     * @return void
     */
    private function buildPaths(): void
    {
        // arguments
        $this->layoutName = strtolower(trim($this->argument('layout')));
        $this->componentName = strtolower(trim($this->argument('name')));

        // paths
        $this->vuePath = RESOURCEPATH . "pages/$this->layoutName/$this->componentName";
        $this->stubsPath = RESOURCEPATH . 'stubs';
    }

    /**
     * Create a sub component using a closure
     *
     * @param string   $option
     * @param \Closure $closure
     *
     * @return self
     */
    private function generateSubComponent(string $option, Closure $closure): self
    {
        // if the option is true
        if ($this->option($option)) {
            $this->line("generating $option");
            $closure();
        }
        // return instance
        return $this;
    }

    /**
     * Create VueJS files
     *
     * @return void
     */
    private function makeVueFiles(): void
    {
        // ----------------------------------------------------------------
        // check for frontend resource directory
        if (!File::exists($this->vuePath)) {
            File::makeDirectory($this->vuePath);
        } else {
            // info message
            $this->info('The frontend resource directory already exists');
        }

        // go through the files and create them as needed
        // build the $paths array
        $paths = [
            [
                "path"   => "$this->vuePath/create.vue",
                "name"   => 'create',
                'create' => $this->layoutName === 'backend',
            ],
            [
                "path"   => "$this->vuePath/index.vue",
                "name"   => 'index',
                'create' => true,
            ],
            [
                "path"   => "$this->vuePath/edit.vue",
                "name"   => 'edit',
                'create' => $this->layoutName === 'backend',
            ],
            [
                "path"   => "$this->vuePath/show.vue",
                "name"   => 'show',
                'create' => true,
            ],
        ];

        // copy the view files
        foreach ($paths as $stub) {
            // check if the vue file exists
            if (File::exists($stub['path'])) {
                $this->info('The ' . $stub['name'] . ' .vue file already exists');
            }
            if ($stub['create']) {
                // copy the file stub
                File::copy("$this->stubsPath/" . "$this->layoutName/" . $stub['name'] . ".vue", $stub['path']);
                $this->info('The ' . $stub['name'] . '.vue file has been created.');
            }
        }
    }

    /**
     * Create a controller
     *
     * @return void
     */
    private function makeController(): void
    {
        $this->callSilently('make:controller', [
            'name' => ucfirst($this->layoutName) . '/' . ucfirst(
                Str::singular($this->componentName)
            ) . 'Controller',
            '-r'   => $this->layoutName === 'backend',
        ]);
    }

    /**
     * Create a model
     *
     * @return void
     */
    private function makeModel(): void
    {
        $this->callSilently('make:model', [
            'name' => ucfirst(Str::singular($this->componentName)),
        ]);
    }

    /**
     * Create a migration
     *
     * @return void
     */
    private function makeMigration(): void
    {
        $this->callSilently('make:migration', [
            'name' => 'create_' . Str::plural($this->componentName) . '_table',
        ]);
    }

    /**
     * Create requests
     *
     * @return void
     */
    private function makeRequests(): void
    {
        // only create while using a backend layout
        if ($this->layoutName === 'backend') {
            $this->callSilently('make:request', [
                'name' =>
                    ucfirst(Str::plural($this->componentName)) . '/' .
                    'Create' . ucfirst(Str::singular($this->componentName)) . 'Request',
            ]);
            $this->callSilently('make:request', [
                'name' =>
                    ucfirst(Str::plural($this->componentName)) . '/' .
                    'Update' . ucfirst(Str::singular($this->componentName)) . 'Request',
            ]);
        }
    }

    /**
     * Create a factory
     *
     * @return void
     */
    private function makeFactory(): void
    {
        $this->callSilently('make:factory', [
            'name' => ucfirst(Str::singular($this->componentName)) . 'Factory',
        ]);
    }

    /**
     * Create a seeder
     *
     * @return void
     */
    private function makeSeeder(): void
    {
        $this->callSilently('make:seeder', [
            'name' => ucfirst(Str::singular($this->componentName)) . 'Seeder',
        ]);
    }

    /**
     * Create a test
     *
     * @return void
     */
    private function makeTest(): void
    {
        $this->callSilently('make:test', [
            'name' => ucfirst($this->layoutName) . '/' . ucfirst($this->componentName) . 'PageTest',
        ]);
    }
}
