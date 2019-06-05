@foreach($reservations as $reservation)
    <tr>
        <td>{{$event->name}}</td>
        <td>{{$reservation->exit_date}}</td>
        <td>{{$reservation->time_start}}</td>
        <td>{{$reservation->time_end}}</td>
        <td>{{$reservation->reservation->children_num}}</td>
        <td>{{$reservation->reservation->getSumm()}}</td>
    </tr>
@endforeach