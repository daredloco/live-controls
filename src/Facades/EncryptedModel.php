<?php

namespace Helvetiapps\LiveControls\Facades;

use Illuminate\Support\Facades\Facade;

class EncryptedModel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'encryptedmodel';
    }
}