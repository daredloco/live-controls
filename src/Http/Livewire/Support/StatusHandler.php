<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Support;

use Helvetiapps\LiveControls\Models\Support\SupportMessage;
use Helvetiapps\LiveControls\Traits\SweetAlert\HasPopups;
use Livewire\Component;

class StatusHandler extends Component
{
    use HasPopups;


    public $supportTicket;

    public $newStatus;

    public function mount(){
        $this->newStatus = $this->supportTicket->status;
    }

    public function render()
    {
        return view('livecontrols::livewire.support.status-handler');
    }

    public function updateStatus(){
        if($this->supportTicket->update([
            'status' => $this->newStatus
        ])){
            $this->popup([
                'type' => 'success',
                'message' => __('livecontrols::support.status_updated')
            ]);
            return;
        }
        $this->popup([
            'type' => 'error',
            'message' => __('livecontrols::support.invalid_status')
        ]);
    }
}
