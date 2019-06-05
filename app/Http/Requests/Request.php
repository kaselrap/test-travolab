<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class Request extends FormRequest
{

    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;
    /**
     * @var array
     */
    protected $rules = [
        'name' => 'required',
    ];

    public function messages()
    {
        return [
            'name.required' => 'Поле название обязательно для заполнения',
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function getErrors()
    {
        return $this->getValidator()->errors();
    }

    /**
     * @return bool
     */
    public function pass()
    {
        return !$this->fails();
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidator()
    {
        return $this->getValidatorInstance();
    }

    /**
     * @return bool
     */
    public function fails()
    {
        $result = $this->getValidatorInstance()->fails();
        $this->errors = $this->getValidatorInstance()->errors();

        return $result;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->rules;
    }

    /**
     * @return \Illuminate\Support\MessageBag
     */
    public function errors(): \Illuminate\Support\MessageBag
    {
        if (!$this->errors) {
            return new \Illuminate\Support\MessageBag;
        }

        return $this->errors;
    }

    /**
     * @param $name
     * @param $validator
     */
    public function addRule($name, $validator)
    {
        $this->rules[$name] = $validator;
    }

    /**
     * @param $name
     */
    public function removeRule($name)
    {
        if (isset($this->rules[$name])) {
            unset($this->rules[$name]);
        }
    }

    /**
     * @param Validator $validator
     * @return bool|void
     */
    protected function failedValidation(Validator $validator)
    {
        return false;
    }
}
