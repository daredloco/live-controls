<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;

class GroupList extends Component
{
    public $search = '';

    public function render()
    {
        if($this->search != ''){
            $groups = UserGroup::where('name', 'LIKE', '%'.$this->search.'%')->paginate();
        }else{
            $groups = UserGroup::paginate();
        }

        return view('livecontrols::livewire.admin.group-list', ['groups' => $groups]);
    }
}
