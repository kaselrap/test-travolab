@extends('home')
@section('tab')
    <div id="v-pills-place" aria-labelledby="v-pills-place-tab">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{route('places')}}" class="btn btn-primary return-back">
                    назад
                </a>
            </div>
        </div>

        <form id="placeForm">
            <div class="form-group">
                <label class="ml-2 mb-2">Название:<span class="color-validation-red">*</span></label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name" placeholder="Название" value="{{$place->name ?? ''}}">
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('places.store', ['id' => $place->id])}}" class="btn btn-primary save-model">Сохранить</a>
                    </div>
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