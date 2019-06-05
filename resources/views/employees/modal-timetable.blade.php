<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">График работы сотрудника -  {{$employee->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Название мероприятия</th>
                        <th>Дата проведения</th>
                        <th>Время начала</th>
                        <th>Время конца</th>
                    </thead>
                    <tbody>
                    @foreach($employee->reservations as $reservation)
                        <tr>
                            <td>{{$reservation->treaty->getPlaceName()}}</td>
                            <td>{{$reservation->treaty->exit_date}}</td>
                            <td>{{$reservation->treaty->time_start}}</td>
                            <td>{{$reservation->treaty->time_end}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>