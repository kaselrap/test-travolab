@extends('home')
@section('tab')
    <div id="v-pills-reports" aria-labelledby="v-pills-reports-tab">
        <div class="container">
            @foreach(collect(config('data.reports'))->chunk(3) as $reports)
                <div class="row">
                    @foreach($reports as $key => $report)
                        @if(!empty($key))
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span class="d-block font-weight-bold text-center">{{__($report['name'])}}</span>
                                        <label for="{{$key}}">
                                            Период
                                        </label>
                                        <input type="text" id="{{$key}}" name="{{$key}}" class="form-control daterangepicker-init">
                                        <a class="btn btn-primary w-100 mt-3 render-route" data-route="{{$report['route']}}" href="{{route($report['route'], ['period' => \Carbon\Carbon::now()->format('m/d/Y') . ' - ' . \Carbon\Carbon::tomorrow()->format('m/d/Y')])}}">Получить отчет</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="col-md-4"></div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            function renderRoute(self, route, time) {
                console.log(time);
                $.ajax({
                    url: '{{route('reports.renderReportLink')}}',
                    dataType: 'json',
                    data: {
                        route:route,
                        time: time
                    },
                    success: function (response) {
                        self.attr('href', response.route);
                    }
                });
            }
            $('.daterangepicker-init').on('change', function () {
                var sibling = $(this).siblings('.render-route');
                renderRoute(sibling, sibling.attr('data-route'), $(this).val());
            });
        });
    </script>
@endpush