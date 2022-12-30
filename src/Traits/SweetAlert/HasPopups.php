<?php

namespace Helvetiapps\LiveControls\Traits\SweetAlert;

trait HasPopups{

    public function popup(array $data){
        $this->dispatchBrowserEvent('popup',$data); 
    }

    public function popupInfo(string $title, string $message, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('popup', [
            'type' => 'info',
            'title' => $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent
        ]);
    }

    public function popupWarn(string $title, string $message, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('popup', [
            'type' => 'warn',
            'title' => $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent
        ]);
    }

    public function popupSuccess(string $title, string $message, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('popup', [
            'type' => 'success',
            'title' => $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent
        ]);
    }

    public function popupError(string $title, string $message, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('popup', [
            'type' => 'error',
            'title' => $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent
        ]);
    }

    public function popupQuestion(string $title, string $message, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('popup', [
            'type' => 'question',
            'title' => $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent
        ]);
    }

    public function popupRedirect(string $route, array $data, array $routeParameters = []){
        return redirect()->route($route, $routeParameters)->with('popup', $data);
    }
}