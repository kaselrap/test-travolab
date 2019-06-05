@extends('home')
@section('tab')
    <div id="v-pills-сдшутеы" aria-labelledby="v-pills-events-tab">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{route('clients')}}" class="btn btn-primary return-back">
                    назад
                </a>
            </div>
        </div>
        <form id="clients">
            <div class="form-group">
                <label class="ml-2 mb-2">{{trans_choice('app.client.name', $type)}}:<span class="color-validation-red">*</span></label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name" placeholder="{{trans_choice('app.client.name', $type)}}" value="{{$client->model->name ?? ''}}">
                    </div>
                </div>
            </div>
            <div class="form-group d-flex">
                <label class="ml-2 mb-2">Постоянный:<span class="color-validation-red">*</span>
                </label>
                <input type="checkbox" class="form-control col-md-1" name="constants" placeholder="{{trans_choice('app.client.constant', $type)}}" value="{{$client->constants ?? ''}}" {{$client->constants == 1 ? 'checked' : ''}}>
            </div>
            @if($type == 1)
                <div class="form-group">
                    <label class="ml-2 mb-2">Тип организации:<span class="color-validation-red">*</span></label>
                    <div class="row">
                        <div class="col-md-4">
                            <select name="organization_types">
                                @foreach(\App\Model\OrganizationType::all() as $organization_type)
                                    <option value="{{$organization_type->id}}" {{$client->model && $organization_type->id  == $client->model->type_id ? 'selected' : ''}}>{{$organization_type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    <a href="{{route('clients.store', ['type' => $type, 'id' => $client->id])}}" class="btn btn-primary save-model">Сохранить</a>
                </div>
            </div>
        </form>
    </div>
@endsection