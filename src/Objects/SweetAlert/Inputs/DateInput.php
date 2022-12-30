<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class DateInput extends NumericInput {
    public function __construct($inputName, $value = "", string $label = "", string $placeHolder, string $min, string $max)
    {
        parent::__construct($inputName, $value, $label, $placeHolder, $min, $max);
        $this->inputType = "date";
    }
}