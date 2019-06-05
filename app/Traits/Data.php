<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait Data
{
    /**
     * @param $name
     * @param string $default
     * @return mixed
     */
    public function getData($name, $default = null)
    {
        return Arr::get($this->data, $name, $default);
    }

}
