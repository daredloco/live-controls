<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class ColorInput extends Input {
    public function __construct($inputName, $value = "", string $label = "")
    {
        parent::__construct($inputName, $value, $label);
        $this->inputType = "color";
        $this->class = 'form-control form-control-color';
    }
}