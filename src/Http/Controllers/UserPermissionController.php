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
            return redirect()->route('livecontrols.admin.index')->with('success', 'UserPermission created!');
        }
        return redirect()->route('livecontrols.admin.index')->with('exception', 'Couldn\'t create UserPermission!');
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
            return redirect()->route('livecontrols.admin.index')->with('success', 'UserPermission updated!');
        }
        return redirect()->route('livecontrols.admin.index')->with('exception', 'Couldn\'t update UserPermission!');
    }

    public function destroy(UserPermission $userPermission){
        if($userPermission->delete()){
            return redirect()->route('livecontrols.admin.index')->with('success', 'UserPermission deleted!');
        }
        return redirect()->route('livecontrols.admin.index')->with('exception', 'Couldn\'t delete UserPermission!');
    }
}
