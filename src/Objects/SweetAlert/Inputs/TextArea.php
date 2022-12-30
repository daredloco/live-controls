<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class TextArea extends Input{

    public $rows;

    public function __construct(string $inputName, string $value = "", string $label = "", int $rows = 3, string $placeHolder = "", string $parentClass = "mt-3")
    {
        $this->rows = $rows;
        parent::__construct($inputName, $value, $label, $placeHolder, $parentClass);
    }

    public function toArray():array{
        $html = '<div class="'.$this->parentClass.'">';
        if($this->label != null && $this->label != ''){
            $html.= '<label for="'.$this->inputName.'" class="form-label">'.$this->label.'</label>';
        }
        $html .= '<textarea class="'.$this->class.'" rows="'.$this->rows.'" name="'.$this->inputName.'" id="'.$this->inputName.'" placeholder="'.$this->placeHolder.'"'.($this->disabled ? ' disabled' : '').($this->required ? ' required' : '').'>'.$this->value.'</textarea>';
        $html .= '</div>';
        return [
            'name' => $this->inputName,
            'html' => $html
        ];
    }
}