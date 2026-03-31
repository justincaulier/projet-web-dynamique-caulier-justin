<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchBar extends Component
{
    public $query;

    public function __construct($query = '')
    {
        $this->query = $query;
    }

    public function render()
    {
        return view('components.search-bar');
    }
}

