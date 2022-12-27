<?php

use Helvetiapps\LiveControls\Http\Controllers\AdminInterfaceController;
use Illuminate\Support\Facades\Route;

//Admin Interface
Route::prefix(config('livecontrols.admininterface_prefix'))->middleware(['admin'])->group(function () {
    //Add routes that can be accessed only by admins
    Route::get('dashboard', [AdminInterfaceController::class, 'index'])->name('showAdminDashboard');
});