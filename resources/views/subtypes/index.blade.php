@extends('home')
@section('tab')
    <div id="v-pills-subtypes" aria-labelledby="v-pills-types-tab">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{route('subtypes.create')}}" class="btn btn-outline-primary create-psubtype">
                    Создать подвид деятельности
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
                            <label for="subname">Название подвида деятельности</label>
                            <div class="input-search mt-1">
                                <input type="text" class="form-control" id="subname" name="filter[subname]" value="{{request()->input('filter.subname', '')}}">
                                <a href="#" class="filter_icon_search" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Поиск">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                        <div data-name="subname" class="sort-search mt-1">
                            <i data-sort="asc" class="fa fa-caret-up sort-search-up color-grey{{Order::compare('subname', 'asc') ? ' active' : ''}}"></i>
                            <i data-sort="desc" class="fa fa-caret-down sort-search-down color-grey{{Order::compare('subname', 'desc') ? ' active' : ''}}"></i>
                        </div>
                    </th>
                    <th>
                        <div class="form-group position-relative">
                            <label for="name">Название вида деятельности</label>
                            <div class="input-search mt-1">
                                <select name="filter[type]" class="select2">
                                    <option value=""></option>
                                    @foreach(\App\Model\Type::getTypeList() as $type)
                                        <option value="{{$type->id}}" {{request()->input('filter.type', '') == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div data-name="type" class="sort-search mt-1">
                            <i data-sort="asc" class="fa fa-caret-up sort-search-up color-grey{{Order::compare('type', 'asc') ? ' active' : ''}}"></i>
                            <i data-sort="desc" class="fa fa-caret-down sort-search-down color-grey{{Order::compare('type', 'desc') ? ' active' : ''}}"></i>
                        </div>
                    </th>
                    <th>
                        <div class="form-group">
                            <a href="#" class="btn btn-primary submit_form">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="{{route('subtypes')}}" class="btn btn-danger reset_form">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                @include('subtypes.items', ['subtypes' => $subtypes])
                </tbody>
            </table>
        </form>
    </div>
@endsection