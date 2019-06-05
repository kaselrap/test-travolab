<?php

namespace App\Http\Requests;

class SubtypeRequest extends Request
{
    protected $rules = [
        'name' => 'required',
        'type_id' => 'required',
    ];

    public function messages()
    {
        return [
            'name.required' => 'Поле название обязательно для заполнения',
            'type_id.required' => 'Вы не можите создать подвид деятельности без вида деятельности',
        ];
    }
}
