<?php

namespace Helvetiapps\LiveControls\Facades;

use Illuminate\Support\Facades\Facade;

class PermissionsHandler extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'permissionshandler';
    }
}