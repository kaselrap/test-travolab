<?php

namespace App\Console\Commands;

use App\Model\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateEventss extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $events = DB::connection('mysql2')->select('SELECT * FROM `dbo.Event`');

        foreach ($events as $event) {
            Event::insert([
                'id' => $event->PK_Event,
                'name' => $event->name,
                'duration' => $event->duration,
                'subtype_id' => $event->FK_Subtype,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => (bool)$event->deleted === true ? now() : null,
            ]);
        }
    }
}
