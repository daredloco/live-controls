<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Helvetiapps\LiveControls\Models\Analytics\Action;
use Helvetiapps\LiveControls\Models\Analytics\Campaign;
use Helvetiapps\LiveControls\Models\Analytics\Request;
use Livewire\Component;

class AnalyticsAdmin extends Component
{
    public $page;

    public $userRequests;
    public $campaigns;
    public $actions;

    protected $queryString = [
        'page' => ['as' => 'p']
    ];
   
    public function mount()
    {
        if(is_null($this->page)){
            $this->page = 'dashboard';
        }
    }

    public function render()
    {
        $this->userRequests = Request::orderBy('created_at', 'desc')->paginate();
        $this->campaigns = Campaign::where('active', '=', true)->orderBy('name')->paginate();
        $this->actions = Action::where('active', '=', true)->orderBy('name')->paginate();
        return view('livecontrols::livewire.admin.analytics-admin');
    }
}
