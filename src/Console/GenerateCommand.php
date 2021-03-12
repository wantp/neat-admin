<?php

namespace Wantp\Neat\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Wantp\Neat\Facades\Neat;

class GenerateCommand extends Command
{
    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'neat:generate 
                            {controller : controllerName e.g. UserController}
                            {--model= : Custom model name e.g. User} 
                            {--filter= : Custom filter name e.g. UserFilter} 
                            {--resource= : Custom resource name e.g. UserResource}
                            {--without-filter : This option will set the property $filterClass to null} 
                            {--without-resource : This option will set the property $resourceClass to null}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate api';

    /**
     * @var string
     */
    private $controllerName;

    /**
     * @var string
     */
    private $modelName;

    /**
     * @var string
     */
    private $filterName;

    /**
     * @var string
     */
    private $resourceName;

    /**
     * @var string
     */
    private $modelPath;

    /**
     * @var string
     */
    private $filterPath;

    /**
     * @var string
     */
    private $resourcePath;

    /**
     * Create a new controller creator command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->controllerName = $this->argument('controller');
        $modelName = Str::ucfirst(Str::singular(Str::replaceLast('Controller', '', $this->controllerName)));
        $this->modelName = $this->option('model') ? $this->option('model') : $modelName;
        $this->filterName = $this->option('filter') ? $this->option('filter') : $this->modelName . 'Filter';
        $this->resourceName = $this->option('resource') ? $this->option('resource') : $this->modelName . 'Resource';

        $this->generateModel();
        $this->generateFilter();
        $this->generateResource();
        $this->generateController();
    }

    /**
     * Generate model
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function generateModel()
    {
        $modelsPath = Neat::modelsPath();
        $this->modelPath = $modelsPath . '/' . $this->modelName . '.php';
        if (file_exists($this->modelPath)) {
            $this->warn('Model already exists!');
            return;
        }
        if (!is_dir($modelsPath)) {
            $this->files->makeDirectory($modelsPath, 0755, true);
        }
        $stub = $this->files->get(__DIR__ . '/stubs/DummyModel.stub');
        $content = str_replace(
            ['DummyNamespace', 'DummyModel'],
            [getAppPsr4NamespaceByPath($modelsPath), $this->modelName],
            $stub
        );
        $this->files->put($this->modelPath, $content);
        $this->line('<info>' . $this->modelName . ' create successed.</info>');
    }

    /**
     * Generate filter
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function generateFilter()
    {
        if ($this->option('without-filter')) {
            return;
        }
        $filtersPath = Neat::filtersPath();
        $this->filterPath = $filtersPath . '/' . $this->filterName . '.php';
        if (file_exists($this->filterPath)) {
            $this->warn('Filter already exists!');
            return;
        }
        if (!is_dir($filtersPath)) {
            $this->files->makeDirectory($filtersPath, 0755, true);
        }
        $stub = $this->files->get(__DIR__ . '/stubs/DummyFilter.stub');
        $content = str_replace(
            ['DummyNamespace', 'DummyFilter'],
            [getAppPsr4NamespaceByPath($filtersPath), $this->filterName],
            $stub
        );
        $this->files->put($this->filterPath, $content);
        $this->line('<info>' . $this->filterName . ' create successed.</info>');
    }

    /**
     * Generate resource
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function generateResource()
    {
        if ($this->option('without-resource')) {
            return;
        }
        $resourcesPath = Neat::resourcesPath();
        $this->resourcePath = $resourcesPath . '/' . $this->resourceName . '.php';
        if (file_exists($this->resourcePath)) {
            $this->warn('Resource already exists!');
            return;
        }
        if (!is_dir($resourcesPath)) {
            $this->files->makeDirectory($resourcesPath, 0755, true);
        }
        $stub = $this->files->get(__DIR__ . '/stubs/DummyResource.stub');
        $content = str_replace(
            ['DummyNamespace', 'DummyResource'],
            [getAppPsr4NamespaceByPath($resourcesPath), $this->resourceName],
            $stub
        );
        $this->files->put($this->resourcePath, $content);
        $this->line('<info>' . $this->resourceName . ' create successed.</info>');
    }

    /**
     * Generate controller
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function generateController()
    {
        $controllersPath = Neat::controllersPath();
        $path = $controllersPath . '/' . $this->controllerName . '.php';
        if (file_exists($path)) {
            $this->warn('Controller already exists!');
            return;
        }
        if (!is_dir($controllersPath)) {
            $this->files->makeDirectory($controllersPath, 0755, true);
        }
        $stub = $this->files->get(__DIR__ . '/stubs/DummyController.stub');

        $useDummyModel = 'use ' . getAppPsr4NamespaceByPath($this->modelPath);
        $useDummyFilter = $this->filterPath ? 'use ' . getAppPsr4NamespaceByPath($this->filterPath) : '';
        $useDummyResource = $this->resourcePath ? 'use ' . getAppPsr4NamespaceByPath($this->resourcePath) : '';

        $dummyModelClass = $this->modelName . '::class';
        $dummyFilterClass = $this->filterPath ? $this->filterName . '::class' : 'NULL';
        $dummyResourceClass = $this->resourcePath ? $this->resourceName . '::class' : 'NULL';

        $content = str_replace(
            [
                'DummyNamespace',
                'use DummyModel',
                'use DummyFilter',
                'use DummyResource',
                'DummyController',
                'DummyModelClass',
                'DummyFilterClass',
                'DummyResourceClass',
                'DummyModel',
                '$dummyModel',
            ],
            [
                getAppPsr4NamespaceByPath($controllersPath),
                $useDummyModel,
                $useDummyFilter,
                $useDummyResource,
                $this->controllerName,
                $dummyModelClass,
                $dummyFilterClass,
                $dummyResourceClass,
                $this->modelName,
                '$' . lcfirst($this->modelName),
            ],
            $stub);
        $this->files->put($path, $content);
        $this->line('<info>' . $this->controllerName . ' create successed.</info>');
    }
}
