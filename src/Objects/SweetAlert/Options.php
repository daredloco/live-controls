<?php

namespace Helvetiapps\LiveControls\Objects\SweetAlert;

class Options
{
    private $options;

    public function __construct()
    {
        $this->options = [];
    }

    public function add($key, $value)
    {
        $this->options[$key] = $value;
    }

    public function get():array{
        return $this->options;
    }
}