@extends('home')
@section('tab')
    <div id="v-pills-request-types" aria-labelledby="v-pills-request-types-tab">

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Телефон</th>
                <th scope="col">Место проведения</th>
                <th scope="col">Дополнительная информация</th>
                <th class="border-left-0"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>
                        {{$request->name}}
                    </td>
                    <td>
                        {{$request->email}}
                    </td>
                    <td>
                        {{$request->phone}}
                    </td>
                    <td>
                        {{\App\Model\Place::getPlaceName($request->place_id)}}
                    </td>
                    <td>
                        {{$request->message}}
                    </td>
                    <td>
                        <a href="{{route('user_requests.delete', ['id' => $request->id])}}" class="delete-model">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection