<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Admin;

use Livewire\Component;
use Helvetiapps\LiveControls\Models\Subscriptions\Subscription;

class SubscriptionList extends Component
{
    public $search = '';

    public function render()
    {
        if($this->search != ''){
            $subscriptions = Subscription::where('name', 'LIKE', '%'.$this->search.'%')->paginate();
        }else{
            $subscriptions = Subscription::paginate();
        }

        return view('livecontrols::livewire.admin.subscription-list', ['subscriptions' => $subscriptions]);
    }
}
