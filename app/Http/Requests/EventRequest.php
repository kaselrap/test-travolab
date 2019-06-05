<?php

namespace App\Http\Requests;

class EventRequest extends Request
{
    protected $rules = [
        'name' => 'required',
        'duration' => 'required|integer',
        'subtype_id' => 'required',
        'place_id' => 'required'
    ];

    public function messages()
    {
        return [
            'name.required' => 'Поле название обязательно для заполнения',
            'duration.required' => 'Поле длительность обязательно для заполнения',
            'duration.integer' => 'Поле длительность должно быть числовое',
            'subtype_id.required' => 'Вы не можите создать мероприятие без типа',
            'place_id.required' => 'Вы не можите создать мероприятие без площадки',
        ];
    }
}
