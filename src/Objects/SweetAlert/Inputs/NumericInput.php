<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class NumericInput extends Input {
    public string $inputType = 'number';

    public ?int $minValue = null;
    public ?int $maxValue = null;
    public ?float $step = null;

    public function __construct($inputName, $label = "", ?int $min = null, ?int $max = null, ?float $step = null)
    {
        $this->minValue = $min;
        $this->maxValue = $max;
        $this->step = $step;
        parent::__construct($inputName, $label);
    }

    public function toArray():array{
        $html = '<div class="'.$this->parentClass.'">';
        if($this->label != null && $this->label != ''){
            $html.= '<label for="'.$this->inputName.'" class="form-label">'.$this->label.'</label>';
        }
        $html .= '<input type="'.$this->inputType.'" class="'.$this->class.'" name="'.$this->inputName.'" id="'.$this->inputName.'" placeholder="'.$this->placeHolder.'"';
        if(!is_null($this->minValue)){
            $html .= ' min="'.$this->minValue.'"';
        }
        if(!is_null($this->maxValue)){
            $html .= ' max="'.$this->maxValue.'"';
        }
        if(!is_null($this->step)){
            $html .= ' step="'.str_replace(',','.', $this->step).'"';
        }
        $html .= '>'; //Close the input tag
        $html .= '</div>';
        return [
            'name' => $this->inputName,
            'html' => $html
        ];
    }
}