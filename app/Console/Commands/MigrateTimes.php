<?php

namespace App\Console\Commands;

use App\Model\EventOnPlace;
use App\Model\Time;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateTimes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:times';

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
        $rows = DB::connection('mysql2')->select('SELECT * FROM `dbo.Times`');

        foreach ($rows as $row) {
            Time::insert([
                'id' => $row->PK_time,
                'time_start' => Carbon::parse($row->begin_time),
                'time_end' => Carbon::parse($row->end_time),
                'type_time' => $row->type_tyme,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => (bool)$row->deleted === true ? now() : null,
            ]);
        }
    }
}
