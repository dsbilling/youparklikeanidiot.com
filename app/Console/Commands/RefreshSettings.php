<?php

namespace DPSEI\Console\Commands;

use Illuminate\Console\Command;
use anlutro\LaravelSettings\Facade as Setting;

class RefreshSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dpsei:refreshsettings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will update all settings with proper description fields.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Add new settings
        if (!Setting::has('APP_SHOW_RESETDB')) {
            Setting::set('APP_SHOW_RESETDB', 0);
            $this->info('Added APP_SHOW_RESETDB setting.');
        }
    }
}
