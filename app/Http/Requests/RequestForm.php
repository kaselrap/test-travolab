<?php

namespace App\Http\Requests;

class RequestForm extends Request
{
    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required'
    ];
}
