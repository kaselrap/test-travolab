<?php

namespace App\Console\Commands;

use App\Model\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:clients';

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
        $clients = DB::connection('mysql2')->select('SELECT * FROM `dbo.Client`');
        foreach ($clients as $client) {
            Client::insert([
                'id' => $client->PK_Client,
                'constants' => $client->constanst,
                'types' => $client->types,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => $client->deleted ? now() : null,
            ]);
        }
    }
}
