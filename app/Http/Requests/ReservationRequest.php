<?php

namespace App\Http\Requests;

class ReservationRequest extends Request
{
    protected $rules = [
        'client_id' => 'required',
        'call_day' => 'date',
        'children_num' => 'integer',
        'receiving' => 'integer',
        'document' => 'integer',
        'exit_date' => 'date',
        'employee_id' => 'required',
    ];

    public function messages()
    {
        return [
            'client_id.required' => 'Выберите клиента',
            'call_day.date' => 'Укажите корректную дату звонка',
            'children_num.integer' => 'Поле "Дети" должно содержать числа',
            'receiving.integer' => 'Поле "Прочие лица" должно содержать числа',
            'document.integer' => 'Поле "Документ" должно содержать числа',
            'exit_date.date' => 'Укажите корректную дату проведения мероприятия',
            'employee_id.required' => 'Выберите сотрудника',
        ];
    }
}
