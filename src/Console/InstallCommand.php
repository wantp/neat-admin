<?php

namespace Wantp\Neat\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Wantp\Neat\Facades\Neat;
use Wantp\Neat\Database\Seeds\AdministratorSeeder;
use Wantp\Neat\Database\Seeds\MenuSeeder;

class InstallCommand extends Command
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
    protected $signature = 'neat:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install neat admin';


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
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if (is_dir(Neat::root())) {
            $this->error(Neat::root() . " directory already exists !");
            return false;
        }

        $this->call('migrate');
        $this->call('db:seed', ['--class' => AdministratorSeeder::class]);
        $this->call('db:seed', ['--class' => MenuSeeder::class]);

        $this->installNeat();

        $this->line('<info>Neat admin install successed.</info>');
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function installNeat()
    {
        $this->installControllers();
        $this->installRoutes();
    }

    protected function installControllers()
    {
        $this->files->makeDirectory(Neat::controllersPath(), 0644, true);
        $this->line('<info>Controller directory create successed:</info>');
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function installRoutes()
    {
        $this->files->put(Neat::routePath(), $this->files->get(__DIR__ . '/stubs/routes.stub'));
        $this->line('<info>Routes file create successed:</info> ');
    }
}
