<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class SelectInput extends Input
{
    public array $options;
    public ?int $size;

    public function __construct(string $inputName, array $options, string|int $value, ?string $label = null, ?int $size = null, $parentClass = "mt-3")
    {
        $this->size = $size;
        $this->options = $options;
        parent::__construct($inputName, $value, $label, "", $parentClass);
    }

    public function toArray():array{
        $html = '<div class="'.$this->parentClass.'">';
        if($this->label != null && $this->label != ''){
            $html.= '<label for="'.$this->inputName.'" class="form-label">'.$this->label.'</label>';
        }
        $html .= '<select id="'.$this->inputName.'" name="'.$this->inputName.'" class="form-select" '.(!is_null($this->size) ? 'size="'.$this->size.'"' : '').'>';
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