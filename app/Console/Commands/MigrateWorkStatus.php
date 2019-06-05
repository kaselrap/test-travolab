<?php

namespace App\Console\Commands;

use App\Model\EventOnPlace;
use App\Model\WorkStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateWorkStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:work_statuses';

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
        $rows = DB::connection('mysql2')->select('SELECT * FROM `dbo.WorkStatus`');

        foreach ($rows as $row) {

            $data = json_encode([
                'monday' => $row->Monday,
                'tuesday' => $row->Tuesday,
                'wednesday' => $row->Wednesday,
                'thursday' => $row->Thursday,
                'friday' => $row->Friday,
                'saturday' => $row->Saturday,
                'sunday' => $row->Sunday,
            ]);

            WorkStatus::insert([
                'id' => $row->PK_Status,
                'employee_id' => $row->FK_Employee,
                'date_start' => $row->dateBegin,
                'date_end' => $row->dateEnd,
                'data' => $data,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => (bool)$row->deleted === true ? now() : null,
            ]);
        }
    }
}
