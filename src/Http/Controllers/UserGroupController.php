<?php

namespace Helvetiapps\LiveControls\Http\Controllers;

use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function create(){
        return view('livecontrols::usergroups.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'key' => 'required|string',
            'color' => 'required',
            'description' => 'nullable|string'
        ]);

        $userGroup = UserGroup::create($validated);

        if(!is_null($userGroup)){
            return redirect('livecontrols.admin.index')->with('success', 'UserGroup created!');
        }
        return redirect('livecontrols.admin.index')->with('exception', 'Couldn\'t create UserGroup!');
    }

    public function edit(UserGroup $userGroup){
        return view('livecontrols::usergroups.edit', ['userGroup' => $userGroup]);
    }

    public function update(Request $request, UserGroup $userGroup){
        $validated = $request->validate([
            'name' => 'required|string',
            'key' => 'required|string',
            'color' => 'required',
            'description' => 'nullable|string'
        ]);

        if($userGroup->update($validated)){
            return redirect('livecontrols.admin.index')->with('success', 'UserGroup updated!');
        }
        return redirect('livecontrols.admin.index')->with('exception', 'Couldn\'t update UserGroup!');
    }

    public function destroy(UserGroup $userGroup){
        if($userGroup->delete()){
            return redirect('livecontrols.admin.index')->with('success', 'UserGroup deleted!');
        }
        return redirect('livecontrols.admin.index')->with('exception', 'Couldn\'t delete UserGroup!');
    }
}
