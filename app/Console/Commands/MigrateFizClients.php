<?php

namespace App\Console\Commands;

use App\Model\EventOnPlace;
use App\Model\FizClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateFizClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:fiz_clients';

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
        $rows = DB::connection('mysql2')->select('SELECT * FROM `dbo.Fiz_client`');

        foreach ($rows as $row) {
            FizClient::insert([
                'id' => $row->PK_Fiz_client,
                'client_id' => $row->FK_Client,
                'name' => $row->name,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => (bool)$row->deleted === true ? now() : null,
            ]);
        }
    }
}
