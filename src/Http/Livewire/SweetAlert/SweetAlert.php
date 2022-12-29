<?php

namespace Helvetiapps\LiveControls\Http\Livewire\SweetAlert;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SweetAlert extends Component
{

    public $hasPopup;

    public $title;
    public $type;
    public $message;

    public $confirmButtonText;
    public $denyButtonText;
    public $cancelButtonText;

    public $confirmEvent;
    public $denyEvent;
    public $cancelEvent;

    protected $listeners = ['popupSent' => 'createPopup'];

    public function mount(){
        $this->hasPopup = false;
        if(Session::has('popup')){
            $popupInfo = Session::get('popup');
            $this->createPopup($popupInfo, false);
        }
    }

    public function render()
    {
        return view('livecontrols::livewire.sweetalert.sweet-alert');
    }

    public function createPopup(array $popupInfo, bool $fromListener = true){
        $this->hasPopup = true;
        $this->type = $popupInfo["type"];
        $this->title = \Helvetiapps\LiveControls\Utils\Arrays::array_get("title", $popupInfo, ucfirst($this->type));
        $this->message = $popupInfo["message"];
        $this->confirmButtonText = \Helvetiapps\LiveControls\Utils\Arrays::array_get('confirmButtonText', $popupInfo);
        $this->denyButtonText = \Helvetiapps\LiveControls\Utils\Arrays::array_get('denyButtonText', $popupInfo);
        $this->cancelButtonText = \Helvetiapps\LiveControls\Utils\Arrays::array_get('cancelButtonText', $popupInfo);
        $this->confirmEvent = \Helvetiapps\LiveControls\Utils\Arrays::array_get('confirmEvent', $popupInfo);
        $this->denyEvent = \Helvetiapps\LiveControls\Utils\Arrays::array_get('denyEvent', $popupInfo);
        $this->cancelEvent = \Helvetiapps\LiveControls\Utils\Arrays::array_get('cancelEvent', $popupInfo);

        if(!$fromListener){
            return;
        }

        $popupArr = [
            'type' => $this->type,
            'title' => $this->title,
            'message' => $this->message,
            'confirmButtonText' => $this->confirmButtonText,
            'denyButtonText' => $this->denyButtonText,
            'cancelButtonText' => $this->cancelButtonText,
            'confirmEvent' => $this->confirmEvent,
            'denyEvent' => $this->denyEvent,
            'cancelEvent' => $this->cancelEvent
        ];

        $this->emit('showPopup', $popupArr);
    }
}
