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

    public function mount(){
        $this->hasPopup = false;
        if(Session::has('popup')){
            $popupInfo = Session::get('popup');
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
        }
    }

    public function render()
    {
        return view('livecontrols::livewire.sweetalert.sweet-alert');
    }
}
