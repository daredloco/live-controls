<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class NumericInput extends Input {
    public $inputType = 'number';
    
    public function __construct($inputName, $label = "")
    {
        parent::__construct($inputName, $label);
    }
}