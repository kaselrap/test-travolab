<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ExcelFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'excelService';
    }
}
