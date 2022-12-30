<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class Input{
    protected string $inputName;
    protected string $label;
    protected string $placeHolder;
    protected string $parentClass;

    protected $value;

    public string $class = 'form-control';
    public string $inputType = 'text';
    public bool $disabled = false;

    public function __construct($inputName, $value = "", string $label = null, $placeHolder = "", bool $disabled = false, $parentClass ="mt-3"){
        $this->inputName = $inputName;
        $this->label = $label;
        $this->placeHolder = $placeHolder;
        $this->parentClass = $parentClass;
        $this->value = $value;
        $this->disabled = $disabled;
    }

    public function toArray():array{
        $html = '<div class="'.$this->parentClass.'">';
        if($this->label != null && $this->label != ''){
            $html.= '<label for="'.$this->inputName.'" class="form-label">'.$this->label.'</label>';
        }
        $html .= '<input type="'.$this->inputType.'" class="'.$this->class.'" name="'.$this->inputName.'" id="'.$this->inputName.'" value="'.$this->value.'" placeholder="'.$this->placeHolder.'"'.($this->disabled ? ' disabled' : '').'>';
        $html .= '</div>';
        return [
            'name' => $this->inputName,
            'html' => $html
        ];
    }

    public function getName():string{
        return $this->inputName;
    }
}