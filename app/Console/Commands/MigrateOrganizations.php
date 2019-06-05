<?php

namespace App\Console\Commands;

use App\Model\EventOnPlace;
use App\Model\Organization;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateOrganizations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:organizations';

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
        $rows = DB::connection('mysql2')->select('SELECT * FROM `dbo.OrganizationTable`');

        foreach ($rows as $row) {
            Organization::insert([
                'id' => $row->PK_Organization,
                'client_id' => $row->FK_Client,
                'type_id' => $row->FK_Type,
                'name' => $row->name,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => (bool)$row->deleted === true ? now() : null,
            ]);
        }
    }
}
