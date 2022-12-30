<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class SelectInput extends Input
{
    public array $options;

    public function __construct(string $inputName, array $options, string|int $value, ?string $label = null, $parentClass = "mt-3")
    {
        $this->options = $options;
        parent::__construct($inputName, $value, $label, "", $parentClass);
    }

    public function toArray():array{
        $html = '<div class="'.$this->parentClass.'">';
        if($this->label != null && $this->label != ''){
            $html.= '<label for="'.$this->inputName.'" class="form-label">'.$this->label.'</label>';
        }
        $html .= '<select id="'.$this->inputName.'" name="'.$this->inputName.'" class="form-select">';
        foreach($this->options as $key => $option){
            $html .= '<option value="'.$key.'" '.($this->value == $key ? 'selected' : '').'>'.$option.'</option>';
        }
        $html .= '</select>';
        $html .= '</div>';
        return [
            'name' => $this->inputName,
            'html' => $html
        ];
    }
}