@foreach($events_coast as $coast)
    <tr>
        <td>{{$coast->getEventName()}}</td>
        <td>{{$coast->coast_less_five_spec}}</td>
        <td>{{$coast->coast_more_five_spec}}</td>
        <td>{{$coast->coast_less_five_other}}</td>
        <td>{{$coast->coast_more_five_other}}</td>
        <td>
            <a href="{{route('event_coast.edit', ['id' => $coast->id])}}" class="edit-type">
                <i class="fa fa-edit"></i>
            </a>
            <a href="{{route('event_coast.delete', ['id' => $coast->id])}}" class="delete-model">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
@endforeach