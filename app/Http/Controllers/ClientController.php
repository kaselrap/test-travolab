<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Model\Client;
use App\Model\Event;
use App\Model\FizClient;
use App\Model\Organization;
use App\Model\OrganizationType;

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
    public function update(Request $request, $type, Client $client = null)
    {
        $errors = $request->getErrors()->all();

        if (count($errors) > 0) {
            return response()->json([
                'failure' => true,
                'errors' => $errors
            ]);
        }

        if (!$client) {
            $client = new Client();
        }

        $client->constants = request()->input('constants', 0);
        $client->types = $type;

        if ($client->save()) {

            $clientType = $client->model;

            if (!$clientType) {
                $clientType = (int)$type === 1 ? new Organization() : new FizClient();
                $clientType->client_id = $client->id;
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
