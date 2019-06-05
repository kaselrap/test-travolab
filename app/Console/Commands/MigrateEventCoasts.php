<?php

namespace App\Console\Commands;

use App\Model\Event;
use App\Model\EventCoast;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateEventCoasts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:event_coast';

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
        $eventCoasts = DB::connection('mysql2')->select('SELECT * FROM `dbo.EventCost`');

        foreach ($eventCoasts as $row) {
            EventCoast::insert([
                'id' => $row->PK_Cost,
                'event_id' => $row->FK_Event,
                'coast_less_five_spec' => $row->CostLessFiveSpec,
                'coast_less_five_other' => $row->CostLessFiveOther,
                'coast_more_five_spec' => $row->CostMoreFiveSpec,
                'coast_more_five_other' => $row->CostMoreFiveOther,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => (bool)$row->deleted === true ? now() : null,
            ]);
        }
    }
}
