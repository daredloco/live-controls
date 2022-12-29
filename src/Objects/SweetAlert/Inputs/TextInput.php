<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class TextInput extends Input {
    public function __construct($inputName, $value = "", string $label = "", string $placeHolder = "")
    {
        parent::__construct($inputName, $value, $label, $placeHolder);
    }
}