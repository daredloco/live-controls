<?php

namespace Helvetiapps\LiveControls\Objects\Calendar;

use Carbon\Carbon;

class CalendarEvents{

    private $events = [];

    public function add(string $title, Carbon $start, Carbon $end = null, bool $allDay = false){
        $event = [
            'title' => $title,
            'start' => $start->format('Y-m-dTH:i:s'),
            'allDay' => $allDay
        ];

        if(!is_null($end)){
            $event["end"] = $end->format('Y-m-dTH:i:s');
        }

        array_push($this->events, $event);
    }

    public function clear(){
        $this->events = [];
    }

    public function get(){
        return $this->events;
    }
}