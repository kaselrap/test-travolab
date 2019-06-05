@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link{{request()->routeIs('requests')? ' active' : ''}}" id="v-pills-employee-tab" href="{{route('user_requests')}}" role="tab" aria-controls="v-pills-employee" aria-selected="false">Запросы на бронирование</a>
                    <a class="nav-link{{request()->routeIs('employees', 'employees.create', 'employees.edit')? ' active' : ''}}" id="v-pills-employee-tab" href="{{route('employees')}}" role="tab" aria-controls="v-pills-employee" aria-selected="false">Сотрудники</a>
                    <a class="nav-link{{request()->routeIs('places', 'places.create', 'places.edit')? ' active' : ''}}" id="v-pills-place-tab" href="{{route('places')}}" role="tab" aria-controls="v-pills-place" aria-selected="true">Площадки</a>
                    <a class="nav-link{{request()->routeIs('types', 'types.create', 'types.edit') ? ' active' : ''}}" id="v-pills-types-tab" href="{{route('types')}}" role="tab" aria-controls="v-pills-types" aria-selected="false">Виды деятельности</a>
                    <a class="nav-link{{request()->routeIs('subtypes', 'subtypes.create', 'subtypes.edit') ? ' active' : ''}}" id="v-pills-subtypes-tab" href="{{route('subtypes')}}" role="tab" aria-controls="v-pills-subtypes" aria-selected="false">Подвиды деятельности</a>
                    <a class="nav-link{{request()->routeIs('events', 'events.create', 'events.edit') ? ' active' : ''}}" id="v-pills-events-tab" href="{{route('events')}}" role="tab" aria-controls="v-pills-events" aria-selected="false">ЭТМ</a>
                    <a class="nav-link{{request()->routeIs('organization.types', 'organization.types.create', 'organization.types.edit') ? ' active' : ''}}" id="v-pills-organization-type-tab" href="{{route('organization.types')}}" role="tab" aria-controls="v-pills-organization-type" aria-selected="false">Виды организаций</a>
                    <a class="nav-link{{request()->routeIs('clients', 'clients.create', 'clients.edit') ? ' active' : ''}}" href="{{route('clients')}}" role="tab" aria-controls="v-pills-clients" aria-selected="false">Клиенты</a>
                    <a class="nav-link{{request()->routeIs('reports') ? ' active' : ''}}" href="{{route('reports')}}" role="tab" aria-controls="v-pills-report" aria-selected="false">Отчеты</a>
                    <a class="nav-link{{request()->routeIs('event_coast', 'event_coast.create', 'event_coast.edit') ? ' active' : ''}}" id="v-pills-events-coast-tab" href="{{route('event_coast')}}" role="tab" aria-controls="v-pills-events-coast" aria-selected="false">Прейскурант цен</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    @yield('tab')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('script')
@endpush