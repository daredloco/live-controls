<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class NumericInput extends Input {
    public string $inputType = 'number';

    public function __construct($inputName, $label = "")
    {
        parent::__construct($inputName, $label);
    }
}