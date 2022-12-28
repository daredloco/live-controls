<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Support;

use Helvetiapps\LiveControls\Models\Support\SupportMessage;
use Livewire\Component;
use Livewire\WithPagination;

class MessagesHandler extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $supportTicket;

    public $newTitle = '';
    public $newBody = '';

    public function render()
    {
        $supportMessages = $this->supportTicket->messages()->orderBy('created_at', 'desc')->paginate();
        return view('livecontrols::livewire.support.messages-handler', ['supportMessages' => $supportMessages]);
    }

    public function sendMessage(){
        $this->validate([
            'newTitle' => 'required',
            'newBody' => 'required'
        ]);

        $supportMessage = SupportMessage::create([
            'user_id' => auth()->id(),
            'support_ticket_id' => $this->supportTicket->id,
            'title' => $this->newTitle,
            'body' => $this->newBody,

        ]);

        if(!is_null($supportMessage)){
            $this->newTitle = '';
            $this->newBody = '';
            $this->dispatchBrowserEvent('showToast', ['success', 'Message sent!']);
            return;
        }
        $this->dispatchBrowserEvent('showToast', ['exception', 'Couldn\'t send message!']);
    }
}
