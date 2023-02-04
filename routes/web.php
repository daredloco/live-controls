<?php

use Helvetiapps\LiveControls\Http\Controllers\AdminInterfaceController;
use Helvetiapps\LiveControls\Http\Controllers\SubscriptionController;
use Helvetiapps\LiveControls\Http\Controllers\SupportTicketController;
use Helvetiapps\LiveControls\Http\Controllers\UserGroupController;
use Helvetiapps\LiveControls\Http\Controllers\UserPermissionController;
use Illuminate\Support\Facades\Route;

//Admin Interface
Route::middleware(array_merge([
    'web',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'],
    config('livecontrols.routes_middlewares',[]) 
    )
    )->group(function(){

        //SUPPORT SYSTEM
        Route::prefix(config('livecontrols.support_prefix', 'support'))->group(function () {
            Route::get('tickets', [SupportTicketController::class, 'index'])->name('livecontrols.support.index');
            Route::get('tickets/new', [SupportTicketController::class, 'create'])->name('livecontrols.support.create');
            Route::post('tickets/new', [SupportTicketController::class, 'store'])->name('livecontrols.support.store');
            Route::get('tickets/show/{supportTicket}', [SupportTicketController::class, 'show'])->name('livecontrols.support.show');
            Route::delete('tickets/delete/{supportTicket}', [SupportTicketController::class, 'destroy'])->name('livecontrols.support.delete');
            Route::get('tickets/reopen/{supportTicket}', [SupportTicketController::class, 'reopen'])->name('livecontrols.support.reopen');
        });
        

        //ADMIN INTERFACE
        Route::prefix(config('livecontrols.admininterface_prefix', 'admin'))->middleware(['admin'])->group(function () {
            //Add routes that can be accessed only by admins
            Route::get('dashboard', [AdminInterfaceController::class, 'index'])->name('livecontrols.admin.dashboard');

            
            //User Groups
            Route::get('usergroups/create', [UserGroupController::class, 'create'])->name('livecontrols.admin.usergroups.create');
            Route::post('usergroups/create', [UserGroupController::class, 'store'])->name('livecontrols.admin.usergroups.store');
            Route::get('usergroups/edit/{userGroup}', [UserGroupController::class, 'edit'])->name('livecontrols.admin.usergroups.edit');
            Route::put('usergroups/edit/{userGroup}', [UserGroupController::class, 'update'])->name('livecontrols.admin.usergroups.update');
            Route::delete('usergroups/delete/{userGroup}', [UserGroupController::class, 'destroy'])->name('livecontrols.admin.usergroups.delete');    
        

            //User Permissions
            Route::get('userpermissions/create', [UserPermissionController::class, 'create'])->name('livecontrols.admin.userpermissions.create');
            Route::post('userpermissions/create', [UserPermissionController::class, 'store'])->name('livecontrols.admin.userpermissions.store');
            Route::get('userpermissions/edit/{userPermission}', [UserPermissionController::class, 'edit'])->name('livecontrols.admin.userpermissions.edit');
            Route::put('userpermissions/edit/{userPermission}', [UserPermissionController::class, 'update'])->name('livecontrols.admin.userpermissions.update');
            Route::delete('userpermissions/delete/{userPermission}', [UserPermissionController::class, 'destroy'])->name('livecontrols.admin.userpermissions.delete');
        
            //Subscriptions
            Route::get('subscriptions/create', [SubscriptionController::class, 'create'])->name('livecontrols.admin.subscriptions.create');
            Route::post('subscriptions/create', [SubscriptionController::class, 'store'])->name('livecontrols.admin.subscriptions.store');
            Route::get('subscriptions/edit/{subscription}', [SubscriptionController::class, 'edit'])->name('livecontrols.admin.subscriptions.edit');
            Route::put('subscriptions/edit/{subscription}', [SubscriptionController::class, 'update'])->name('livecontrols.admin.subscriptions.update');
            Route::delete('subscriptions/delete/{subscription}', [SubscriptionController::class, 'destroy'])->name('livecontrols.admin.subscriptions.delete');
        });
        
});