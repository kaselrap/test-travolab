<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Расписание мероприятей для экскурсии -  {{$event->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Экскурсия</th>
                                <th>Дата проведения</th>
                                <th scope="col">Время начало</th>
                                <th scope="col">Время конца</th>
                                <th scope="col">Количество людей</th>
                                <th scope="col">Стоимость</th>
                            </tr>
                            </thead>
                            <tbody class="reservations">
                            @include('events.reservations', ['reservations' => $event->treaties, 'event' => $event])
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <form id="reservationForm">
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <input type="hidden" name="event_on_place_id" value="{{$event->getEventOnPlaceId()}}">
                        <div class="col-md-12 form-group d-flex flex-column">
                            <label for="client_id">Клиент</label>
                            <select id="client_id" name="client_id">
                                @foreach(\App\Model\Client::getClients('all') as $client)
                                    <option value="{{$client->id}}">{{$client->client_name ?? $client->organization_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group d-flex flex-column">
                            <label for="date_call">Дата звонка</label>
                            <input type="text" class="datepicker" id="date_call" name="call_day">
                        </div>
                        <div class="col-md-12 form-group d-flex flex-column">
                            <label for="phone">Телефон</label>
                            <input type="text" class="phone" id="phone" name="phone">
                        </div>
                        <div class="col-md-12 form-group d-flex flex-column">
                            <label for="children_num">Дети, школьники, сотрудники ПГУ</label>
                            <input type="number" id="children_num" name="children_num">
                        </div>
                        <div class="col-md-12 form-group d-flex flex-column">
                            <label for="receiving">Прочие лица</label>
                            <input type="number" id="receiving" name="receiving">
                        </div>
                        <div class="col-md-12 form-group d-flex flex-column">
                            <label for="document">Документ</label>
                            <input type="text" id="document" name="document">
                        </div>
                        <div class="col-md-12 form-group d-flex flex-column">
                            <label for="exit_date">Дата проведения</label>
                            <input type="text" id="exit_date" name="exit_date" class="datepicker">
                        </div>
                        <div class="col-md-12 form-group d-flex flex-column">
                            <label for="time_start">Время начала</label>
                            <input type="time" id="time_start" name="time_start" value="10:00">
                        </div>
                        <div class="col-md-12 form-group d-flex flex-column">
                            <label for="employee_id">Сотрудник</label>
                            <select id="employee_id" name="employee_id">
                                @foreach(\App\Model\Employee::getAllList() as $employee)
                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button class="btn btn-primary add-reservation">Забронировать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>