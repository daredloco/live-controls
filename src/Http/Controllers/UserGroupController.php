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
            return redirect()->route('livecontrols.admin.dashboard', ['p' => 'groups'])->with('success', __('livecontrols::general.type_created', ['type' => __('livecontrols::admin.user_group')]));
        }
        return redirect()->route('livecontrols.admin.dashboard', ['p' => 'groups'])->with('exception', __('livecontrols::general.type_not_created', ['type' => __('livecontrols::admin.user_group')]));
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
            return redirect()->route('livecontrols.admin.dashboard', ['p' => 'groups'])->with('success', __('livecontrols::general.type_updated', ['type' => __('livecontrols::admin.user_group')]));
        }
        return redirect()->route('livecontrols.admin.dashboard', ['p' => 'groups'])->with('exception', __('livecontrols::general.type_not_updated', ['type' => __('livecontrols::admin.user_group')]));
    }

    public function destroy(UserGroup $userGroup){
        if($userGroup->delete()){
            return redirect()->route('livecontrols.admin.dashboard', ['p' => 'groups'])->with('success', __('livecontrols::general.type_deleted', ['type' => __('livecontrols::admin.user_group')]));
        }
        return redirect()->route('livecontrols.admin.dashboard', ['p' => 'groups'])->with('exception', __('livecontrols::general.type_not_deleted', ['type' => __('livecontrols::admin.user_group')]));
    }
}
