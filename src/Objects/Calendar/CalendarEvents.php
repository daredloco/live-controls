<?php

namespace Helvetiapps\LiveControls\Objects\Calendar;

use Carbon\Carbon;

class CalendarEvents{

    private $events = [];

    public function __construct()
    {
        
    }

    public function add(string $id, string $title, Carbon $start, Carbon $end = null, bool $allDay = false, string $backgroundColor = null, string $textColor = null, string $borderColor = null){
        $event = [
            'id' => $id,
            'title' => $title,
            'start' => $start->format('Y-m-d').'T'.$start->format('H:i:s'),
            'allDay' => $allDay
        ];

        if(!is_null($backgroundColor)){
            $event['backgroundColor'] = $backgroundColor;
        }
        if(!is_null($textColor)){
            $event['textColor'] = $textColor;
        }
        if(!is_null($borderColor)){
            $event['borderColor'] = $borderColor;
        }
        
        if(!is_null($end)){
            $event["end"] = $end->format('Y-m-d').'T'.$end->format('H:i:s');
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