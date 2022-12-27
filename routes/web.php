<?php

use Helvetiapps\LiveControls\Http\Controllers\AdminInterfaceController;
use Helvetiapps\LiveControls\Http\Controllers\UserGroupController;
use Helvetiapps\LiveControls\Http\Controllers\UserPermissionController;
use Illuminate\Support\Facades\Route;

//Admin Interface
Route::middleware(['web'])->group(function(){
    Route::prefix(config('livecontrols.admininterface_prefix'))->middleware(['admin'])->group(function () {
        //Add routes that can be accessed only by admins
        Route::get('dashboard', [AdminInterfaceController::class, 'index'])->name('livecontrols.admin.dashboard');

        //User Groups
        Route::get('usergroups/create', [UserGroupController::class, 'create'])->name('livecontrols.admin.usergroups.create');
        Route::get('usergroups/create', [UserGroupController::class, 'store'])->name('livecontrols.admin.usergroups.store');
        Route::get('usergroups/edit/{userGroup}', [UserGroupController::class, 'edit'])->name('livecontrols.admin.usergroups.edit');
        Route::get('usergroups/edit/{userGroup}', [UserGroupController::class, 'update'])->name('livecontrols.admin.usergroups.update');
        Route::post('usergroups/delete/{userGroup}', [UserGroupController::class, 'destroy'])->name('livecontrols.admin.usergroups.delete');

        //User Permissions
        Route::get('userpermissions/create', [UserPermissionController::class, 'create'])->name('livecontrols.admin.userpermissions.create');
        Route::get('userpermissions/create', [UserPermissionController::class, 'store'])->name('livecontrols.admin.userpermissions.store');
        Route::get('userpermissions/edit/{userPermission}', [UserPermissionController::class, 'edit'])->name('livecontrols.admin.userpermissions.edit');
        Route::get('userpermissions/edit/{userPermission}', [UserPermissionController::class, 'update'])->name('livecontrols.admin.userpermissions.update');
        Route::post('userpermissions/delete/{userPermission}', [UserPermissionController::class, 'destroy'])->name('livecontrols.admin.userpermissions.delete');
    });
});