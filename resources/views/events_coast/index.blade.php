@extends('home')
@section('tab')
    <div id="v-pills-types" aria-labelledby="v-pills-types-tab">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{route('event_coast.create')}}" class="btn btn-outline-primary">
                    Создать прейскурант
                </a>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Название мероприятия</th>
                <th scope="col">Стоимость дети (до 5)</th>
                <th scope="col">Стоимость дети (от 6)</th>
                <th scope="col">Стоимость прочие (до 5)</th>
                <th scope="col">Стоимость прочие (от 6)</th>
                <th class="border-left-0"></th>
            </tr>
            </thead>
            <tbody>
            @include('events_coast.items', ['events_coast' => $events_coast])
            </tbody>
        </table>

        {{$events_coast->links()}}
    </div>
@endsection