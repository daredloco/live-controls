<?php

namespace Helvetiapps\LiveControls\Http\Livewire\Calendar;

use Carbon\Carbon;
use Exception;
use Livewire\Component;

class Calendar extends Component
{
    public $elementId;
    public $locale;
    public $events;
    public $convertedEvents;
    
    public $eventClickCallback;
    public $eventClickBrowserEvent;
    public $eventClickLiveEvent;

    public $initialView;

    public $random;

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
        if(is_null($this->initialView)){
            $this->initialView = "dayGridMonth";
        }
    }

    public function render()
    {
        //$this->random = Carbon::now()->timestamp;
        return view('livecontrols::livewire.calendar.calendar');
    }

    public function hydrate(){
        $this->dispatchBrowserEvent('refreshCalendar');
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

    public function clickEvent($info){
        if(!is_null($this->eventClickCallback)){
            $callback = $this->eventClickCallback;
            if(!is_callable($callback)){
                throw new Exception("The clickEvent callback \"".$callback."\" is not callable!");
            }
            $callback($info);
        }
        if(!is_null($this->eventClickBrowserEvent)){
            $this->dispatchBrowserEvent($this->eventClickBrowserEvent, $info);
        }
        if(!is_null($this->eventClickLiveEvent)){
            $this->emit($this->eventClickLiveEvent, $info);
        }
    }
}
