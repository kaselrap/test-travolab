@extends('home')
@section('tab')
    <div id="v-pills-place" aria-labelledby="v-pills-place-tab">
        @can('show', \App\User::class)
            <div class="row mb-3">
                <div class="col-md-12">
                    <a href="{{route('places.create')}}" class="btn btn-outline-primary create-place">
                        Создать Площадку
                    </a>
                </div>
            </div>
        @endcan
        <form class="form-sort-find">
            <input type="hidden" name="order[name]" class="order_by_name" value="{{request()->input('order.name', 'created_at')}}">
            <input type="hidden" name="order[value]" class="order_by_value" value="{{request()->input('order.value', 'desc')}}">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">
                        <div class="form-group position-relative">
                            <label for="name">Название площадки</label>
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
                    <th class="border-left-0">
                        <div class="form-group">
                            <a href="#" class="btn btn-primary submit_form">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="{{route('places')}}" class="btn btn-danger reset_form">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                @include('places.items', ['places' => $places])
                </tbody>
            </table>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $('.delete-place').on('click', function (e) {
            e.preventDefault();

            var url = $(this).attr('href');

            $.ajax({
                url: url,
                success: function (response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });

        })
    </script>
@endpush