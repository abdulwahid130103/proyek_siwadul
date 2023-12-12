<?php

namespace App\View\Components\Pengadu;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $style = null;
    public $script = null;
    public function __construct($title = null)
    {
        $this->title = $title ?? "Siwadul";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('pengadu.layouts.app');
    }
}
