<?php

namespace App\Console\Commands;

use App\Model\Event;
use App\Model\EventOnPlace;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateEventOnPlace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:event_on_place';

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
        $rows = DB::connection('mysql2')->select('SELECT * FROM `dbo.EventOnPlace`');

        foreach ($rows as $row) {
            EventOnPlace::insert([
                'id' => $row->PK_EoP,
                'place_id' => $row->FK_Place,
                'event_id' => $row->FK_Event,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => (bool)$row->deleted === true ? now() : null,
            ]);
        }
    }
}
