<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\Event;
use App\Model\OrganizationType;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index', [
            'fizClients' =>  Client::getClients(0),
            'organizations' => Client::getClients(1)
        ]);
    }

    /**
     * @param Client|null $client
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($type, Client $client = null)
    {
        return view('clients.edit', ['client' => $client ?: new Client(), 'type' => $type]);
    }

    /**
     * @param Event|null $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($type, Client $client = null)
    {
        if (!$client) {
            $client = new Client();
        }

        $client->constants = request()->input('constants', 0);

        if ($client->save()) {

            $clientType = $client->model;

            if (!$clientType->exists) {
                $clientType = new $client->model();
            }

            $clientType->name = request()->input('name', '');
            if ($type == 1) {
                $clientType->type_id = request()->input('organization_types', OrganizationType::getFirst() ?: '');
            }

            $clientType->save();

            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'failure' => true,
        ]);
    }

    /**
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Event $event)
    {
        return response()->json([
            'success' => $event->delete()
        ]);
    }
}
