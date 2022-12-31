<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Support;

use Helvetiapps\LiveControls\Models\Support\SupportMessage;
use Helvetiapps\LiveControls\Traits\SweetAlert\HasPopups;
use Livewire\Component;
use Livewire\WithPagination;

class MessagesHandler extends Component
{
    use WithPagination;
    use HasPopups;

    protected $paginationTheme = 'bootstrap';

    public $supportTicket;

    public $newTitle = '';
    public $newBody = '';

    public function render()
    {
        $supportMessages = $this->supportTicket->messages()->orderBy('created_at', 'desc')->paginate(5, ['*'], 'comments');
        return view('livecontrols::livewire.support.messages-handler', ['supportMessages' => $supportMessages]);
    }

    public function sendMessage(){
        $this->validate([
            'newTitle' => 'nullable',
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
            $this->popup(['type' => 'success', 'message' =>__('livecontrols::support.message_sent')]);
            return;
        }
        $this->popup(['type' => 'exception', 'message' => __('livecontrols::support.message_not_sent')]);
    }

    public function removeMessage($id){
        $supportMessage = SupportMessage::find($id);
        if(auth()->id() != $supportMessage->user_id && !auth()->user()->support_team){
            return;
        }
        if($supportMessage->delete()){
            $this->popup(['type' => 'success', 'message' => __('livecontrols::general.type_deleted', ['type' => __('livecontrols::support.message')])]);
            return;
        }
        $this->popup(['type' => 'exception', 'message' => __('livecontrols::general.type_not_deleted', ['type' => __('livecontrols::support.message')])]);
    }
}
