<?php

namespace Helvetiapps\LiveControls\Traits\SweetAlert;

trait HasPopups{

    public function popup(array $data){
        $this->dispatchBrowserEvent('popup',$data); 
    }

    public function popupInfo(?string $title, string $message, ?int $timer = null, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('popup', [
            'type' => 'info',
            'title' => is_null($title) ? __('livecontrols::alerts.info') : $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent,
            'timer' => $timer,
            'timerProgressBar' => is_null($timer) ? null : true
        ]);
    }

    public function popupWarn(?string $title, string $message, ?int $timer = null, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('popup', [
            'type' => 'warning',
            'title' => is_null($title) ? __('livecontrols::alerts.warning') : $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent,
            'timer' => $timer,
            'timerProgressBar' => is_null($timer) ? null : true
        ]);
    }

    public function popupSuccess(?string $title, string $message, ?int $timer = null, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('popup', [
            'type' => 'success',
            'title' => is_null($title) ? __('livecontrols::alerts.success') : $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent,
            'timer' => $timer,
            'timerProgressBar' => is_null($timer) ? null : true
        ]);
    }

    public function popupError(?string $title, string $message, ?int $timer = null, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('popup', [
            'type' => 'error',
            'title' => is_null($title) ? __('livecontrols::alerts.error') : $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent,
            'timer' => $timer,
            'timerProgressBar' => is_null($timer) ? null : true
        ]);
    }

    public function popupQuestion(?string $title, string $message, ?int $timer = null, string $confirmText = null, string $confirmEvent = null, string $denyText = null, string $denyEvent = null, string $cancelText = null, string $cancelEvent = null){
        $this->dispatchBrowserEvent('popup', [
            'type' => 'question',
            'title' => is_null($title) ? __('livecontrols::alerts.question') : $title,
            'message' => $message,
            'confirmButtonText' => $confirmText,
            'confirmEvent' => $confirmEvent,
            'denyButtonText' => $denyText,
            'denyEvent' => $denyEvent,
            'cancelButtonText' => $cancelText,
            'cancelEvent' => $cancelEvent,
            'timer' => $timer,
            'timerProgressBar' => is_null($timer) ? null : true
        ]);
    }

    public function popupRedirect(string $route, array $data, array $routeParameters = []){
        return redirect()->route($route, $routeParameters)->with('popup', $data);
    }
}