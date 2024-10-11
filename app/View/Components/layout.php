<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class layout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     * 
     * @return \Illuminate\View\View|string
     */
    public function render(): View|Closure|string
    {
        return view('components.layout');
    }
}
