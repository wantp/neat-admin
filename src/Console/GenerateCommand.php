<?php

namespace Wantp\Neat\Console;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
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
    protected $signature = 'neat:genarate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genarate admin api';

    protected $controller;
    protected $controllerName;
    protected $model;
    protected $resource;

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
     */
    public function handle()
    {
        // TODO Genarate admin api
    }
}
