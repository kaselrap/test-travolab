@extends('home')
@section('tab')
    <div id="v-pills-subtypes" aria-labelledby="v-pills-subtypes-tab">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{route('subtypes')}}" class="btn btn-primary return-back">
                    назад
                </a>
            </div>
        </div>

        <form id="subtypeForm">
            <div class="form-group">
                <label class="ml-2 mb-2">Название:<span class="color-validation-red">*</span></label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name" placeholder="Название" value="{{$subtype->name ?? ''}}">
                    </div>
                    <div class="col-md-4">
                        <select name="type_id" id="type_id" class="type_id">
                            @foreach(\App\Model\Type::getTypeList() as $type)
                                <option value="{{$type->id}}"{{$type->id == $subtype->type_id ? ' selected' : ''}}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('subtypes.store', ['id' => $subtype->id])}}" class="btn btn-primary save-model">Сохранить</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection