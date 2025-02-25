<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInput extends Component
{
    public $id;
    public $name;
    public $options;
    public $oldValue;

    public function __construct($id, $name, $options, $oldValue = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->options = $options;
        $this->oldValue = $oldValue;
    }

    public function render()
    {
        return view('components.select-input');
    }
}