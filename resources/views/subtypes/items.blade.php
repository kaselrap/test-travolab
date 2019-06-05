@foreach($subtypes as $subtype)
    <tr>
        <td>{{$subtype->name}}</td>
        <td>{{$subtype->type->name}}</td>
        <td>
            <a href="{{route('subtypes.edit', ['id' => $subtype->id])}}" class="edit-type">
                <i class="fa fa-edit"></i>
            </a>
            <a href="{{route('subtypes.delete', ['id' => $subtype->id])}}" class="delete-model">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
@endforeach