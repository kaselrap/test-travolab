<?php

namespace App\Console\Commands;

use App\Model\Client;
use App\Model\Employee;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateEmployee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:employees';

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
        $employees = DB::connection('mysql2')->select('SELECT * FROM `dbo.Employee`');

        foreach ($employees as $employee) {
            Employee::insert([
                'id' => $employee->PK_Employee,
                'name' => $employee->name,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => $employee->deleted ? now() : null,
            ]);
        }
    }
}
