<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CourseCard extends Component
{
    public $title;
    public $description;
    public $image;


    public function __construct($title, $description, $image)
    {
        $this->$title = $title;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('client.components.course-card');
    }
}
