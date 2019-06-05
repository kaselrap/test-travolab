@foreach($employees as $employee)
    <tr>
        <td>{{$employee->name}}</td>
        <td>
            <a href="{{route('employees.showSchedule', ['id' => $employee->id])}}" class="show-schedule">
                <i class="fa fa-eye"></i>
            </a>
            <a href="{{route('employees.show_timetable', ['id' => $employee->id])}}" class="show-timetable">
                <i class="fa fa-calendar" aria-hidden="true"></i>
            </a>
           @can('show', \App\User::class)
                <a href="{{route('employees.edit', ['id' => $employee->id])}}" class="edit-place">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{route('employees.delete', ['id' => $employee->id])}}" class="delete-model">
                    <i class="fa fa-trash"></i>
                </a>
           @endcan
        </td>
    </tr>
@endforeach