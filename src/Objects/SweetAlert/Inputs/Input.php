<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class Input{
    protected string $inputName;
    protected string $label;
    protected string $placeHolder;
    protected string $parentClass;

    public string $class = 'form-control';
    public string $inputType = 'text';

    public function __construct($inputName, $label = null, $placeHolder = "", $parentClass ="mt-3"){
        $this->inputName = $inputName;
        $this->label = $label;
        $this->placeHolder = $placeHolder;
        $this->parentClass = $parentClass;
    }

    public function toArray():array{
        $html = '<div class="'.$this->parentClass.'">';
        if($this->label != null && $this->label != ''){
            $html.= '<label for="'.$this->inputName.'" class="form-label">'.$this->label.'</label>';
        }
        $html .= '<input type="'.$this->inputType.'" class="'.$this->class.'" name="'.$this->inputName.'" id="'.$this->inputName.'" placeholder="'.$this->placeHolder.'">';
        $html .= '</div>';
        return [
            'name' => $this->inputName,
            'html' => $html
        ];
    }
}