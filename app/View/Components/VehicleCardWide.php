<?php

namespace App\View\Components;

use Illuminate\View\Component;

class VehicleCardWide extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $vehicle;

    public function __construct($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.vehicle-card-wide');
    }
}
