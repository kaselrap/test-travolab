@extends('home')
@section('tab')
    @php
        Order::init(request('order', [
            'name' => 'created_at',
            'value' => 'desc'
        ]));
    @endphp
    <div id="v-pills-clients" aria-labelledby="v-pills-clients-tab">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{route('clients.create', ['type' => 0])}}" class="btn btn-outline-primary">
                    Создать физическое лицо
                </a>
                <a href="{{route('clients.create', ['type' => 1])}}" class="btn btn-outline-primary">
                    Создать организацию
                </a>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link{{request()->input('type', 0) == 0 ? ' active' : ''}}" id="fiz-tab" data-toggle="tab" href="#fiz" role="tab" aria-controls="fiz" aria-selected="true">Физичесое лицо</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{request()->input('type', 0) == 1 ? ' active' : ''}}" id="organization-tab" data-toggle="tab" href="#organization" role="tab" aria-controls="organization" aria-selected="false">Организация</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade{{request()->input('type', 0) == 0 ? ' show active' : ''}}" id="fiz" role="tabpanel" aria-labelledby="fiz-tab">
                <form class="form-sort-find">
                    <input type="hidden" name="type" value="0">
                    <input type="hidden" name="order[name]" class="order_by_name" value="{{request()->input('order.name', 'created_at')}}">
                    <input type="hidden" name="order[value]" class="order_by_value" value="{{request()->input('order.value', 'desc')}}">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">
                                <div class="form-group position-relative">
                                    <label for="filter_company">{{trans_choice('app.client.name', 0)}}</label>
                                    <div class="input-search mt-1">
                                        <input type="text" class="form-control" name="filter[client_name]" value="{{request()->input('filter.client_name', '')}}">
                                        <a href="#" class="filter_icon_search" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Поиск">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </div>
                                </div>
                                <div data-name="client_name" class="sort-search mt-1">
                                    <i data-sort="asc" class="fa fa-caret-up sort-search-up color-grey{{Order::compare('client_name', 'asc') ? ' active' : ''}}"></i>
                                    <i data-sort="desc" class="fa fa-caret-down sort-search-down color-grey{{Order::compare('client_name', 'desc') ? ' active' : ''}}"></i>
                                </div>
                            </th>
                            <th scope="col">
                                <div class="form-group position-relative">
                                    <label for="filter_company">{{trans_choice('app.client.type', 0)}}</label>
                                    <div class="input-search mt-1">
                                        <select name="filter[client_type]" class="select2">
                                            <option value=""></option>
                                            <option value="active" {{request()->input('filter.client_type', '') == "active" ? 'selected' : ''}}>Постоянный</option>
                                            <option value="nonactive" {{request()->input('filter.client_type', '') == "nonactive" ? 'selected' : ''}}>Не Постоянный</option>
                                        </select>
                                    </div>
                                </div>
                                <div data-name="client_type" class="sort-search mt-1">
                                    <i data-sort="asc" class="fa fa-caret-up sort-search-up color-grey{{Order::compare('client_type', 'asc') ? ' active' : ''}}"></i>
                                    <i data-sort="desc" class="fa fa-caret-down sort-search-down color-grey{{Order::compare('client_type', 'desc') ? ' active' : ''}}"></i>
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
                        @include('clients.items', ['clients' => $fizClients])
                        </tbody>
                    </table>
                </form>

                {{$fizClients->links()}}
            </div>
            <div class="tab-pane fade{{request()->input('type', 0) == 1 ? ' show active' : ''}}" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                <form class="form-sort-find">
                    <input type="hidden" name="type" value="1">
                    <input type="hidden" name="order[name]" class="order_by_name" value="{{request('order.name', 'created_at')}}">
                    <input type="hidden" name="order[value]" class="order_by_value" value="{{request('order.value', 'desc')}}">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">
                                <div class="form-group position-relative">
                                    <label for="filter_company">{{trans_choice('app.client.name', 1)}}</label>
                                    <div class="input-search mt-1">
                                        <input type="text" class="form-control" name="filter[organization_name]" value="{{request()->input('filter.organization_name', '')}}">
                                        <a href="#" class="filter_icon_search" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Поиск">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </div>
                                </div>
                                <div data-name="organization_name" class="sort-search mt-1">
                                    <i data-sort="asc" class="fa fa-caret-up sort-search-up color-grey{{Order::compare('organization_name', 'asc') ? ' active' : ''}}"></i>
                                    <i data-sort="desc" class="fa fa-caret-down sort-search-down color-grey{{Order::compare('organization_name', 'desc') ? ' active' : ''}}"></i>
                                </div>
                            </th>
                            <th scope="col">
                                <div class="form-group position-relative">
                                    <label for="filter_company">{{trans_choice('app.client.type', 1)}}</label>
                                    <div class="input-search mt-1">
                                        <select name="filter[organization_client_type]" class="select2">
                                            <option value=""></option>
                                            <option value="active" {{request()->input('filter.organization_client_type', '') == "active" ? 'selected' : ''}}>Постоянный</option>
                                            <option value="nonactive" {{request()->input('filter.organization_client_type', '') == "nonactive" ? 'selected' : ''}}>Не Постоянный</option>
                                        </select>
                                    </div>
                                </div>
                                <div data-name="organization_client_type" class="sort-search mt-1">
                                    <i data-sort="asc" class="fa fa-caret-up sort-search-up color-grey{{Order::compare('organization_client_type', 'asc') ? ' active' : ''}}"></i>
                                    <i data-sort="desc" class="fa fa-caret-down sort-search-down color-grey{{Order::compare('organization_client_type', 'desc') ? ' active' : ''}}"></i>
                                </div>
                            </th>
                            <th scope="col">
                                <div class="form-group position-relative">
                                    <label for="filter_company">Тип организации</label>
                                    <div class="input-search mt-1">
                                        <select name="filter[type]" class="select2">
                                            <option value=""></option>
                                            @foreach(\App\Model\OrganizationType::all() as $type)
                                                <option value="{{$type->id}}" {{request()->input('filter.type', '') == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div data-name="organization_type" class="sort-search mt-1">
                                    <i data-sort="asc" class="fa fa-caret-up sort-search-up color-grey{{Order::compare('organization_type', 'asc') ? ' active' : ''}}"></i>
                                    <i data-sort="desc" class="fa fa-caret-down sort-search-down color-grey{{Order::compare('organization_type', 'desc') ? ' active' : ''}}"></i>
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
                        @include('clients.items', ['clients' => $organizations])
                        </tbody>
                    </table>
                </form>

                {{$organizations->links()}}
            </div>
        </div>
    </div>
@endsection