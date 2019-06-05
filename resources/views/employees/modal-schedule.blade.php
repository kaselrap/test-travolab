<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Расписание сотрудника -  {{$employee->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Дата начала</th>
                        <th>Дата конца</th>
                        <th scope="col">ПН</th>
                        <th scope="col">ВТ</th>
                        <th scope="col">СР</th>
                        <th scope="col">ЧТ</th>
                        <th scope="col">ПТ</th>
                        <th scope="col">СБ</th>
                        <th scope="col">ВС</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employee->schedules as $schedule)
                        <tr>
                            <td>
                                {{\Carbon\Carbon::parse($schedule->date_start)->format('m/d/Y')}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($schedule->date_end)->format('m/d/Y')}}
                            </td>
                            @foreach(config('data.days') as $day)
                                <td>{{$day && !empty($schedule->getData($day)) && !empty($schedule->getPeriod()) ? $schedule->getPeriod() : ''}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>