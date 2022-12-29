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

    public $html;

    public $confirmButtonText;
    public $denyButtonText;
    public $cancelButtonText;

    public $confirmEvent;
    public $denyEvent;
    public $cancelEvent;

    public $hasInput;

    public $timer;
    public $timerProgressBar;

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
        $this->message = \Helvetiapps\LiveControls\Utils\Arrays::array_get('message', $popupInfo);
        $this->html = \Helvetiapps\LiveControls\Utils\Arrays::array_get('html', $popupInfo);
        $this->confirmButtonText = \Helvetiapps\LiveControls\Utils\Arrays::array_get('confirmButtonText', $popupInfo);
        $this->denyButtonText = \Helvetiapps\LiveControls\Utils\Arrays::array_get('denyButtonText', $popupInfo);
        $this->cancelButtonText = \Helvetiapps\LiveControls\Utils\Arrays::array_get('cancelButtonText', $popupInfo);
        $this->confirmEvent = \Helvetiapps\LiveControls\Utils\Arrays::array_get('confirmEvent', $popupInfo);
        $this->denyEvent = \Helvetiapps\LiveControls\Utils\Arrays::array_get('denyEvent', $popupInfo);
        $this->cancelEvent = \Helvetiapps\LiveControls\Utils\Arrays::array_get('cancelEvent', $popupInfo);
        $this->timer = \Helvetiapps\LiveControls\Utils\Arrays::array_get('timer', $popupInfo, null);
        $this->timerProgressBar = \Helvetiapps\LiveControls\Utils\Arrays::array_get('timerProgressBar', $popupInfo, false);
        $this->hasInput = \Helvetiapps\LiveControls\Utils\Arrays::array_get('hasInput', $popupInfo, false);

        if(!$fromListener){
            return;
        }

        $popupArr = [
            'type' => $this->type,
            'title' => $this->title,
            'timer' => $this->timer,
            'timerProgressBar' => $this->timerProgressBar,
            'message' => $this->message,
            'html' => $this->html,
            'confirmButtonText' => $this->confirmButtonText,
            'denyButtonText' => $this->denyButtonText,
            'cancelButtonText' => $this->cancelButtonText,
            'confirmEvent' => $this->confirmEvent,
            'denyEvent' => $this->denyEvent,
            'cancelEvent' => $this->cancelEvent,
            'hasInput' => $this->hasInput
        ];

        $this->emit('showPopup', $popupArr);
    }
}
