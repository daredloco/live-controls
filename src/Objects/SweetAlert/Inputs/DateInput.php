<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class DateInput extends NumericInput {
    public function __construct($inputName, $value = "", string $label = "", string $min, string $max)
    {
        parent::__construct($inputName, $value, $label, "");
        $this->minValue = $min;
        $this->maxValue = $max;
        $this->inputType = "date";
    }
}