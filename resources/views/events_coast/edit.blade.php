@extends('home')
@section('tab')
    <div id="v-pills-eventы-coast" aria-labelledby="v-pills-events-tab">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{route('event_coast')}}" class="btn btn-primary return-back">
                    назад
                </a>
            </div>
        </div>
        <form id="event_coast">
            @if($eventCoast->id && !empty($eventCoast->getEventName()))
                <input type="hidden" name="event_id" value="{{$eventCoast->event_id}}">
            @else
                <div class="form-group">
                    <label class="ml-2 mb-2">Мероприятие:<span class="color-validation-red">*</span></label>
                    <div class="row">
                        <div class="col-md-4">
                            <select name="event_id">
                                @foreach(\App\Model\Event::getListForEventCoast() as $event)
                                    <option value="{{$event->id}}" {{$event->id  == $eventCoast->event_id ? 'selected' : ''}}>{{$event->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endif
            <div class="form-group d-flex">
                <label class="ml-2 mb-2">Стоимость детям / школьникам / сотрудникам ПГУ(до 5 человек):<span class="color-validation-red">*</span>
                </label>
                <input type="text" class="form-control col-md-1" name="coast_less_five_spec" value="{{$eventCoast->coast_less_five_spec ?? 0}}">
            </div>
            <div class="form-group d-flex">
                <label class="ml-2 mb-2">Стоимость детям / школьникам / сотрудникам ПГУ(от 6 человек):<span class="color-validation-red">*</span>
                </label>
                <input type="text" class="form-control col-md-1" name="coast_more_five_spec" value="{{$eventCoast->coast_more_five_spec ?? 0}}">
            </div>

            <div class="form-group d-flex">
                <label class="ml-2 mb-2">Стоимость прочим лицам (до 5 человек):<span class="color-validation-red">*</span>
                </label>
                <input type="text" class="form-control col-md-1" name="coast_less_five_other" value="{{$eventCoast->coast_less_five_other ?? 0}}">
            </div>
            <div class="form-group d-flex">
                <label class="ml-2 mb-2">Стоимость прочим лицам (от 6 человек):<span class="color-validation-red">*</span>
                </label>
                <input type="text" class="form-control col-md-1" name="coast_more_five_other" value="{{$eventCoast->coast_more_five_other ?? 0}}">
            </div>

            <div class="row">
                <div class="col-md-3">
                    <a href="{{route('event_coast.store', ['id' => $eventCoast->id])}}" class="btn btn-primary save-model">Сохранить</a>
                </div>
            </div>
        </form>
    </div>
@endsection