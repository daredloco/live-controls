<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Calendar;

use Livewire\Component;

class Calendar extends Component
{
    public $elementId;
    public $locale;
    public $events;
    public $convertedEvents;
    
    public function mount(){
        if(is_null($this->elementId)){
            $this->elementId = "calendar";
        }
        if(is_null($this->locale)){
            $this->locale = "en";
        }
        if(is_null($this->events)){
            $this->events = [];
        }
        if(is_null($this->convertedEvents)){
            $this->convertEvents();
        }
    }

    public function render()
    {
        return view('livecontrols::livewire.calendar.calendar');
    }

    private function convertEvents()
    {
        $events = [];

        foreach($this->events as $title => $start){
            $event = [
                'title' => $title,
                'start' => $start
            ];

            array_push($events, $event);
        }

        $this->convertedEvents = $events;
    }
}
