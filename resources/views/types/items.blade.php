@foreach($types as $type)
    <tr>
        <td>{{$type->name}}</td>
        <td>
            <a href="{{route('types.edit', ['id' => $type->id])}}" class="edit-type">
                <i class="fa fa-edit"></i>
            </a>
            <a href="{{route('types.delete', ['id' => $type->id])}}" class="delete-model">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
@endforeach