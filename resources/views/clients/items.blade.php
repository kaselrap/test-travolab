@foreach($clients as $client)
    <tr>
        <td>{{$client->types == 1 ? $client->organization_name : $client->client_name}}</td>
        <td>{{trans_choice('app.client.constant', (int)$client->constants)}}</td>
        @if($client->types == 1)
            <td>{{$client->type_name}}</td>
        @endif
        <td>
            <a href="{{route('clients.edit', ['id' => $client->id, 'type' => $client->types])}}" class="edit-type">
                <i class="fa fa-edit"></i>
            </a>
            <a href="{{route('clients.delete', ['id' => $client->id, 'type' => $client->types])}}" class="delete-model">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
@endforeach