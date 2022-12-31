<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class FileInput extends Input
{
    public function __construct($inputName, string $label = "", string $parentClass)
    {
        parent::__construct($inputName, "", $label, "", $parentClass);
        $this->inputType = "file";
    }
}