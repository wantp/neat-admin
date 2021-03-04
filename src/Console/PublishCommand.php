<?php

namespace Wantp\Neat\Console;

use Illuminate\Console\Command;
use Wantp\Neat\NeatServiceProvider;

class PublishCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'neat:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish neat resource';


    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', ['--provider' => NeatServiceProvider::class]);
    }
}
