<?php

use Illuminate\Support\Facades\Route;

//Admin Interface
Route::prefix(config('livecontrols.admininterface_prefix'))->middleware(['admin'])->group(function () {
    //Add routes that can be accessed only by admins
});