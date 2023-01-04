<?php

namespace Helvetiapps\LiveControls\Http\Livewire\MaskedInput;

use Livewire\Component;

class MaskedInput extends Component
{
    public $required; //If true, will set required to the input

    public $label;
    public $helperText;
    public $placeholder;
    public $inputID;
    public $cleanID;
    public $inputType;
    public $mask;
    public $masks;

    public $currencySign = 'R$';
    public $value;
    public $cleanValue;

    public function mount()
    {
        if(is_null($this->required))
        {
            $this->required = false;
        }
        if($this->inputType == "currency" && is_null($this->cleanValue))
        {
            $this->cleanValue = 0;
        }
    }

    public function updated($name, $value)
    {
        if($name == "value")
        {
            $this->emit($this->inputID.'-valueUpdated', ['value' => $value]);
            $this->emit($this->inputID.'-cleanValueUpdated', ['value' => $this->cleanValue]);
        }
    }

    public function render()
    {
        return view('livecontrols::livewire.maskedinput.input');
    }
}
