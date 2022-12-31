<?php

namespace Helvetiapps\LiveControls\Http\Controllers;

use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function create(){
        return view('livecontrols::userpermissions.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'key' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $userPermission = UserPermission::create($validated);

        if(!is_null($userPermission)){
            return redirect()->route('livecontrols.admin.dashboard', ['p' => 'permissions'])->with('success', __('livecontrols::general.type_created', ['type' => __('livecontrols::admin.permission')]));
        }
        return redirect()->route('livecontrols.admin.dashboard', ['p' => 'permissions'])->with('exception',  __('livecontrols::general.type_not_created', ['type' => __('livecontrols::admin.permission')]));
    }

    public function edit(UserPermission $userPermission){
        return view('livecontrols::userpermissions.edit', ['userPermission' => $userPermission]);
    }

    public function update(Request $request, UserPermission $userPermission){
        $validated = $request->validate([
            'name' => 'required|string',
            'key' => 'required|string',
            'description' => 'nullable|string'
        ]);

        if($userPermission->update($validated)){
            return redirect()->route('livecontrols.admin.dashboard', ['p' => 'permissions'])->with('success',  __('livecontrols::general.type_updated', ['type' => __('livecontrols::admin.permission')]));
        }
        return redirect()->route('livecontrols.admin.dashboard', ['p' => 'permissions'])->with('exception',  __('livecontrols::general.type__not_updated', ['type' => __('livecontrols::admin.permission')]));
    }

    public function destroy(UserPermission $userPermission){
        if($userPermission->delete()){
            return redirect()->route('livecontrols.admin.dashboard', ['p' => 'permissions'])->with('success',  __('livecontrols::general.type_deleted', ['type' => __('livecontrols::admin.permission')]));
        }
        return redirect()->route('livecontrols.admin.dashboard', ['p' => 'permissions'])->with('exception',  __('livecontrols::general.type_not_deleted', ['type' => __('livecontrols::admin.permission')]));
    }
}
