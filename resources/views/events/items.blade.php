@foreach($events as $event)
    <tr>
        <td>{{$event->name}}</td>
        <td>{{$event->duration}}</td>
        <td>{{$event->subtype->name}}</td>
        <td>{{$event->places->first()->name}}</td>
        <td>
            <a href="{{route('events.renderRequestModal', ['id' => $event->id])}}" class="render-modal-bid-request">
                <i class="fa fa-ticket" aria-hidden="true"></i>
            </a>
            <a href="{{route('events.edit', ['id' => $event->id])}}" class="edit-type">
                <i class="fa fa-edit"></i>
            </a>
            <a href="{{route('events.delete', ['id' => $event->id])}}" class="delete-model">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
@endforeach