@extends('home')
@section('tab')
    <div id="v-pills-organization-types" aria-labelledby="v-pills-organization-types-tab">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{route('organization.types')}}" class="btn btn-primary return-back">
                    назад
                </a>
            </div>
        </div>

        <form id="organizationTypeForm">
            <div class="form-group">
                <label class="ml-2 mb-2">Название:<span class="color-validation-red">*</span></label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name" placeholder="Название" value="{{$organizationType->name ?? ''}}">
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('organization.types.store', ['id' => $organizationType->id])}}" class="btn btn-primary save-model">Сохранить</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection