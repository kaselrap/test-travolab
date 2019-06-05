@extends('home')
@section('tab')
    <div id="v-pills-events" aria-labelledby="v-pills-умутеы-tab">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{route('events.create')}}" class="btn btn-outline-primary">
                    Создать вид организации
                </a>
            </div>
        </div>

        <form class="form-sort-find">
            <input type="hidden" name="order[name]" class="order_by_name" value="{{request()->input('order.name', 'created_at')}}">
            <input type="hidden" name="order[value]" class="order_by_value" value="{{request()->input('order.value', 'desc')}}">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">
                        <div class="form-group position-relative">
                            <label for="name">Название мероприятия</label>
                            <div class="input-search mt-1">
                                <input type="text" class="form-control" id="name" name="filter[name]" value="{{request()->input('filter.name', '')}}">
                                <a href="#" class="filter_icon_search" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Поиск">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                        <div data-name="name" class="sort-search mt-1">
                            <i data-sort="asc" class="fa fa-caret-up sort-search-up color-grey{{Order::compare('name', 'asc') ? ' active' : ''}}"></i>
                            <i data-sort="desc" class="fa fa-caret-down sort-search-down color-grey{{Order::compare('name', 'desc') ? ' active' : ''}}"></i>
                        </div>
                    </th>
                    <th scope="col" style="width: 120px;">
                        <div class="form-group position-relative">
                            <label for="duration">Длительность</label>
                            <div class="input-search mt-1">
                                <input type="text" class="form-control" id="duration" name="filter[duration]" value="{{request()->input('filter.duration', '')}}">
                                <a href="#" class="filter_icon_search" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Поиск">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                        <div data-name="duration" class="sort-search mt-1">
                            <i data-sort="asc" class="fa fa-caret-up sort-search-up color-grey{{Order::compare('duration', 'asc') ? ' active' : ''}}"></i>
                            <i data-sort="desc" class="fa fa-caret-down sort-search-down color-grey{{Order::compare('duration', 'desc') ? ' active' : ''}}"></i>
                        </div>
                    </th>
                    <th scope="col">
                        <div class="form-group position-relative">
                            <label for="type">Тип</label>
                            <div class="input-search mt-1">
                                <input type="text" class="form-control" id="type" name="filter[type]" value="{{request()->input('filter.type', '')}}">
                                <a href="#" class="filter_icon_search" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Поиск">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                        <div data-name="type" class="sort-search mt-1">
                            <i data-sort="asc" class="fa fa-caret-up sort-search-up color-grey{{Order::compare('type', 'asc') ? ' active' : ''}}"></i>
                            <i data-sort="desc" class="fa fa-caret-down sort-search-down color-grey{{Order::compare('type', 'desc') ? ' active' : ''}}"></i>
                        </div>
                    </th>
                    <th scope="col">
                        <div class="form-group position-relative">
                            <label for="place">Площадка</label>
                            <div class="input-search mt-1">
                                <input type="text" class="form-control" id="place" name="filter[place]" value="{{request()->input('filter.place', '')}}">
                                <a href="#" class="filter_icon_search" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Поиск">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                        <div data-name="place" class="sort-search mt-1">
                            <i data-sort="asc" class="fa fa-caret-up sort-search-up color-grey{{Order::compare('place', 'asc') ? ' active' : ''}}"></i>
                            <i data-sort="desc" class="fa fa-caret-down sort-search-down color-grey{{Order::compare('place', 'desc') ? ' active' : ''}}"></i>
                        </div>
                    </th>
                    <th class="border-left-0">
                        <div class="form-group">
                            <a href="#" class="btn btn-primary submit_form">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="{{route('clients')}}" class="btn btn-danger reset_form">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                @include('events.items', ['events' => $events])
                </tbody>
            </table>
        </form>
        {{$events->links()}}
    </div>
@endsection
@push('scripts')
    <script>
        var modalWindow = null;
        $('.render-modal-bid-request').on('click', function (e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('href'),
                success: function (response) {
                    if (response.success) {
                        modalWindow = $(response.data);

                        modalWindow.on('hidden.bs.modal', function () {
                            $(this).remove();
                        });

                        modalWindow.on('shown.bs.modal', function () {
                            $('select').select2();
                            $('.datepicker').datepicker();

                            $(modalWindow).on('click', '.add-reservation', function (e) {
                                e.preventDefault();

                                $.ajax({
                                    url: '{{route('events.addReservation')}}',
                                    type: 'post',
                                    data: $('#reservationForm').serialize(),
                                    success: function (response) {
                                        if (response.success) {
                                            swal({
                                                icon: 'success',
                                                title: 'Успешно',
                                                text: 'Успешно забронировано'
                                            }).then(() => {
                                                $('.reservations').html(response.data);
                                                document.getElementById('reservationForm').reset();
                                            });
                                        }
                                        if (response.failure) {
                                            swal({
                                                icon: 'error',
                                                title: 'Ошибка',
                                                text: response.errors[0],
                                                html: true
                                            });
                                        }
                                    }
                                });
                            });
                        });

                        modalWindow.modal('show');
                    }
                }
            });
        });
    </script>
@endpush