<?php

namespace Iamdevmaniac\Recordsapi\Facades;

use Illuminate\Support\Facades\Facade;

class RecordsApiFacade extends Facade{
    protected static function getFacadeAccessor() {
        return 'recordsapi';
    }

}
