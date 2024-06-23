<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeatureMovieCard extends Component
{
    public $featureMovie;
    public function __construct($featureMovie)
    {
        $this->featureMovie = $featureMovie;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.feature-movie-card');
    }
}
