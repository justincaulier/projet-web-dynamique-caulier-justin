<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Slider extends Component
{
    public $images;

    /**
     * Create a new component instance.
     *
     * @param array $images
     */
    public function __construct(array $images)
    {
        $this->images = $images;
    }

    public function render()
    {
        return view('components.slider');
    }
}
