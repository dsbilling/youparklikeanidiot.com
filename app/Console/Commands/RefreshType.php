<?php

namespace DPSEI\Console\Commands;

use DPSEI\Type;
use Illuminate\Console\Command;

class RefreshType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dpsei:refreshtype';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will add any missing default types.';

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
        $types = [
            'Annet, se kommentar',
            'To plasser, en bil',
            'Parkering/all stans forbudt',
            'For langt unna innkjørselen',
            'For nær/i innkjørsel',
            'Over de malte linjene',
            'Dobbeltparkering',
            'Parkert på handicap plass uten merke',
            'I sykkelfelt',
            'På fortauet',
            'Reservert ladestasjon for EL-kjøretøy',
            'Parkert på ladestasjon uten å lade',
        ];

        foreach ($types as $type) {
            $found = Type::where('title', $type)->first();
            if (!$found) {
                $this->info('Did not find "'.$type.'" type, adding.');
                Type::Create([
                    'title' => $type,
                ]);
            } else {
                $this->info('Found "'.$type.'" type.');
            }
        }
    }
}
