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

    public $radix = ',';
    public $thousandsSeparator = '.';
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
        }elseif($this->inputType == "currency" && !is_null($this->cleanValue))
        {
            //THIS IS A FIX WHEN IN SOME CASES THE RADIX FROM JAVASCRIPT AND THE ONE FROM PHP AREN'T THE SAME. THERE IS PROBABLY A BETTER FIX
            $this->cleanValue = number_format($this->cleanValue, 2, $this->radix, $this->thousandsSeparator);
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
