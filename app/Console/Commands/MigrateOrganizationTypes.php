<?php

namespace App\Console\Commands;

use App\Model\EventOnPlace;
use App\Model\OrganizationType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateOrganizationTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:organization_types';

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
        $rows = DB::connection('mysql2')->select('SELECT * FROM `dbo.OrganizationType`');

        foreach ($rows as $row) {
            OrganizationType::insert([
                'id' => $row->PK_Type,
                'name' => $row->name,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => (bool)$row->deleted === true ? now() : null,
            ]);
        }
    }
}
