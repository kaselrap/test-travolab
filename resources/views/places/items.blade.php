@foreach($places as $place)
    <tr>
        <td>{{$place->name}}</td>
        <td>
           @can('show', \App\User::class)
                <a href="{{route('places.edit', ['id' => $place->id])}}" class="edit-place">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{route('places.delete', ['id' => $place->id])}}" class="delete-model">
                    <i class="fa fa-trash"></i>
                </a>
           @endcan
        </td>
    </tr>
@endforeach