@foreach($organizationTypes as $organizationType)
    <tr>
        <td>{{$organizationType->name}}</td>
        <td>
            <a href="{{route('organization.types.edit', ['id' => $organizationType->id])}}" class="edit-type">
                <i class="fa fa-edit"></i>
            </a>
            <a href="{{route('organization.types.delete', ['id' => $organizationType->id])}}" class="delete-model">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
@endforeach