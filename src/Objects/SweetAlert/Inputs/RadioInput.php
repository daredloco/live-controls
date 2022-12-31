<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert\Inputs;

class RadioInput extends Input {

    public string $groupName;
    public bool $checked = false;

    public function __construct(string $inputName, $value, string $label, bool $checked = false, string $parentClass = "mt-3")
    {
        $this->groupName = $inputName;
        $this->checked = $checked;
        parent::__construct($inputName, $value, $label, "",$parentClass);
    }

    public function toArray():array{
        return [
            'name' => $this->inputName,
            'html' => $this->generateHtml()
        ];
    }

    protected function generateHtml():string{
        return '<div class="form-check '.$this->parentClass.'">
            <input class="form-check-input" type="radio" name="'.$this->groupName.'" id="'.$this->inputName.'" value="'.$this->value.'"'.($this->checked ? ' checked="1"' : '').($this->disabled ? ' disabled' : '').'>
            <label class="form-check-label" for="'.$this->inputName.'">
            '.$this->label.'
            </label>
        </div>';
    }
}