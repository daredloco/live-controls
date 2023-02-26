<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Helvetiapps\LiveControls\Models\Analytics\Action;
use Helvetiapps\LiveControls\Models\Analytics\Campaign;
use Helvetiapps\LiveControls\Models\Analytics\Request;
use Helvetiapps\LiveControls\Scripts\Analytics\AnalyticsHandler;
use Carbon\Carbon;
use Livewire\Component;

class AnalyticsAdmin extends Component
{
    public $tab;

    public $from;
    public $to;

    protected $queryString = [
        'tab' => ['as' => 'tab']
    ];
   
    public function mount()
    {
        if(is_null($this->from)){
            $this->from = Carbon::now()->startOfMonth()->format('Y-m-d');
        }
        if(is_null($this->to)){
            $this->to = Carbon::now()->endOfMonth()->format('Y-m-d');
        }

        if(is_null($this->tab)){
            $this->tab = 'dashboard';
        }
    }

    public function render()
    {
        $from = new Carbon($this->from);
        $to = new Carbon($this->to);
        $userRequests = Request::orderBy('created_at', 'desc')->paginate();
        $paths = AnalyticsHandler::getPaths($from, $to);
        $campaigns = Campaign::where('active', '=', true)->orderBy('name')->paginate();
        $actions = Action::where('active', '=', true)->orderBy('name')->paginate();
        return view('livecontrols::livewire.admin.analytics-admin', ['paths' => $paths, 'userRequests' => $userRequests, 'campaigns' => $campaigns, 'actions' => $actions]);
    }
}
