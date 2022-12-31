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
    public bool $required = false;

    public function __construct(string $inputName, $value = "", string $label = null, string $placeHolder = "", string $parentClass ="mt-3"){
        $this->inputName = $inputName;
        $this->label = $label;
        $this->placeHolder = $placeHolder;
        $this->parentClass = $parentClass;
        $this->value = $value;
    }

    public function toArray():array{
        
        return [
            'name' => $this->inputName,
            'html' => $this->generateHtml()
        ];
    }

    protected function generateHtml():string{
        $html = '<div class="'.$this->parentClass.'">';
        if($this->label != null && $this->label != ''){
            $html.= '<label for="'.$this->inputName.'" class="form-label">'.$this->label.'</label>';
        }
        $html .= '<input type="'.$this->inputType.'" class="'.$this->class.'" name="'.$this->inputName.'" id="'.$this->inputName.'" value="'.$this->value.'" placeholder="'.$this->placeHolder.'"'.($this->disabled ? ' disabled' : '').($this->required ? ' required' : '').'>';
        $html .= '</div>';
        return $html;
    }

    public function getName():string{
        return $this->inputName;
    }

    public function setDisabled(bool $disabled){
        $this->disabled = $disabled;
    }
}