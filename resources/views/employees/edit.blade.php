@extends('home')
@section('tab')
    <div id="v-pills-employee" aria-labelledby="v-pills-employee-tab">
        <form id="placeForm">
            <div class="row mb-3">
                <div class="col-md-12">
                    <a href="{{route('employees')}}" class="btn btn-primary return-back">
                        назад
                    </a>
                    <a href="{{route('employees.store', ['id' => $employee->id])}}" class="btn btn-primary save-model">Сохранить</a>
                </div>
            </div>
            <div class="form-group">
                <label class="ml-2 mb-2">Фамилия Имя Отчество:<span class="color-validation-red">*</span></label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name[]" placeholder="Имя" value="{{$employee->first_name ?? ''}}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name[]" placeholder="Фамилия" value="{{$employee->last_name ?? ''}}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name[]" placeholder="Отчество" value="{{$employee->middle_name ?? ''}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
            @foreach(config('data.days') as $value)
                <div class="col-md-4">
                    <label for="{{$value}}">{{__('days.' . $value)}}</label>
                    <input class="checkbox" type="checkbox" id="{{$value}}" name="work_statuses[data][{{$value}}]" value="{{$employee->schedule ? $employee->schedule->getData($value, '') : ''}}" {{$employee->schedule ? $employee->schedule->getData($value, '') : '' == 1 ? 'checked' : ''}}>
                </div>
            @endforeach
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="date_start">Дата начала рабочего периода:</label>
                        <input type="date" id="date_start" name="work_statuses[date_start]" value="{{$employee->schedule ? $employee->schedule->date_start : now()}}">
                    </div>
                    <div class="col-md-4">
                        <label for="date_end">Дата окончания рабочего периода:</label>
                        <input type="date" id="date_end" name="work_statuses[date_end]" value="{{$employee->schedule ? $employee->schedule->date_end : now()}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <label for="type_time">Сверхурочный график</label>
                    <input type="checkbox" name="work_statuses[data][type_time]" value="{{$employee->schedule ? $employee->schedule->getData('type_time', '') : ''}}" {{$employee->schedule ? $employee->schedule->getData('type_time', '') : '' == 1 ? 'checked' : ''}}>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <label for="time_start">Дата начала рабочего периода:</label>
                    <input type="time" id="time_start" name="work_statuses[data][time_start]" value="{{$employee->schedule ? $employee->schedule->getData('time_start', '') : ''}}">
                </div>
                <div class="col-md-4">
                    <label for="time_end">Дата окончания рабочего периода:</label>
                    <input type="time" id="time_end" name="work_statuses[data][time_end]" value="{{$employee->schedule ? $employee->schedule->getData('time_end', '') : ''}}">
                </div>
            </div>

        </form>
    </div>
@endsection
@push('scripts')
    <script>
        (function ($) {
            $(document).ready(function () {
                $('.save-place').on('click', function (e) {
                    e.preventDefault();

                    var url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: $('#placeForm').serialize(),
                        success: function (response) {
                            if (response.success) {
                                window.location.href = '{{route('places')}}';
                            }
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endpush