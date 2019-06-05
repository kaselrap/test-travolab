@extends('home')
@section('tab')
    <div id="v-pills-events" aria-labelledby="v-pills-events-tab">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{route('events')}}" class="btn btn-primary return-back">
                    назад
                </a>
            </div>
        </div>

        <form id="eventForm">
           <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-4">
                               <label class="ml-2 mb-2">Название:<span class="color-validation-red">*</span></label>
                               <input type="text" class="form-control" name="name" placeholder="Название" value="{{$event->name ?? ''}}">
                           </div>
                           <div class="col-md-4">
                               <label class="ml-2 mb-2">Длительность:</label>
                               <input type="number" class="form-control" name="duration" placeholder="Длительность" value="{{$event->duration ?? ''}}">
                           </div>
                       </div>
                   </div>
               </div>
           </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 d-flex flex-column">
                                <label class="ml-2 mb-2">Тип:</label>
                                <select name="subtype_id">
                                    <option value=""></option>
                                    @foreach(\App\Model\Subtype::getList() as $type)
                                        <option value="{{$type->id}}"{{$type->id == $event->subtype_id ? ' selected' : ''}}>{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 d-flex flex-column">
                                <label class="ml-2 mb-2">Площадка:</label>
                                <select name="place_id">
                                    <option value=""></option>
                                    @foreach(\App\Model\Place::getList() as $type)
                                        <option value="{{$type->id}}"{{$event->places->first() instanceof \App\Model\Place && $type->id == $event->places->first()->id ? ' selected' : ''}}>{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{route('events.store', ['id' => $event->id])}}" class="btn btn-primary save-model">Сохранить</a>
                </div>
            </div>
        </form>
    </div>
@endsection