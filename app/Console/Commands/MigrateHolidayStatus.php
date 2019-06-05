<?php

namespace App\Console\Commands;

use App\Model\EventOnPlace;
use App\Model\HolidayStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateHolidayStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:holiday_status';

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
        $rows = DB::connection('mysql2')->select('SELECT * FROM `dbo.HolidayStatus`');

        foreach ($rows as $row) {
            HolidayStatus::insert([
                'id' => $row->PK_HS,
                'dateStart' => $row->dateBegin,
                'dateEnd' => $row->dateEnd,
                'reason' => $row->reason,
                'work_status_id' => $row->FK_WorkStatus,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => (bool)$row->deleted === true ? now() : null,
            ]);
        }
    }
}
