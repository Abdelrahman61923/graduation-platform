<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class aside extends Component
{
    public $items;
    public $active;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = config('aside');
        $this->active = Route::currentRouteName();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.aside');
    }
}
