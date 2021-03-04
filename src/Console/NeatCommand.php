<?php

namespace Wantp\Neat\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Wantp\Neat\Facades\Neat;

class NeatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'neat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all neat admin commands';

    /**
     * @var string
     */
    public static $logo = <<<LOGO
╔╗╔┌─┐┌─┐┌┬┐  ╔═╗┌┬┐┌┬┐┬┌┐┌
║║║├┤ ├─┤ │   ╠═╣ │││││││││
╝╚╝└─┘┴ ┴ ┴   ╩ ╩─┴┘┴ ┴┴┘└┘                                                                                
LOGO;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line(static::$logo);
        $this->line('Neat admin current version:' . Neat::version());

        $this->comment('');
        $this->comment('Available commands:');

        $this->listAvailableCommands();
    }

    /**
     * List all available commands.
     *
     * @return void
     */
    protected function listAvailableCommands()
    {
        $commands = collect(Artisan::all())->mapWithKeys(function ($command, $key) {
            if (Str::startsWith($key, 'neat:')) {
                return [$key => $command];
            }

            return [];
        })->toArray();

        $width = $this->getColumnWidth($commands);

        /** @var Command $command */
        foreach ($commands as $command) {
            $this->line(sprintf(" %-{$width}s %s", $command->getName(), $command->getDescription()));
        }
    }

    /**
     * @param array $commands
     * @return int|mixed
     */
    private function getColumnWidth(array $commands)
    {
        $widths = [];

        foreach ($commands as $command) {
            $widths[] = $this->stringLength($command->getName());
            foreach ($command->getAliases() as $alias) {
                $widths[] = $this->stringLength($alias);
            }
        }

        return $widths ? max($widths) + 2 : 0;
    }

    /**
     * @param $string
     * @return false|int
     */
    private function stringLength($string)
    {
        return ($encoding = mb_detect_encoding($string, null, true)) ? mb_strwidth($string, $encoding) : strlen($string);
    }
}

