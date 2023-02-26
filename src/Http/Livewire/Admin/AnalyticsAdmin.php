<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Helvetiapps\LiveControls\Models\Analytics\Action;
use Helvetiapps\LiveControls\Models\Analytics\Campaign;
use Helvetiapps\LiveControls\Models\Analytics\Request;
use Livewire\Component;

class AnalyticsAdmin extends Component
{
    public $tab;

    protected $queryString = [
        'tab' => ['as' => 'tab']
    ];
   
    public function mount()
    {
        if(is_null($this->tab)){
            $this->tab = 'dashboard';
        }
    }

    public function render()
    {
        $userRequests = Request::orderBy('created_at', 'desc')->paginate();
        $campaigns = Campaign::where('active', '=', true)->orderBy('name')->paginate();
        $actions = Action::where('active', '=', true)->orderBy('name')->paginate();
        return view('livecontrols::livewire.admin.analytics-admin', ['userRequests' => $userRequests, 'campaigns' => $campaigns, 'actions' => $actions]);
    }
}
