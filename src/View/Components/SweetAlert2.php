<?php

namespace Helvetiapps\LiveControls\View\Components;

use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class SweetAlert2 extends Component
{
    public $hasPopup = false;

    public $title;
    public $type;
    public $message;

    public $confirmButtonText;
    public $denyButtonText;
    public $cancelButtonText;

    public $confirmEvent;
    public $denyEvent;
    public $cancelEvent;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
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

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('livecontrols::components.sweetalert2');
    }
}
