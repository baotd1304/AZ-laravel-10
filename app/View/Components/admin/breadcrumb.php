<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class breadcrumb extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $route1;
    public $route2;
    public $route3;
    public $name2;
    public $name3;
    public $id;
    public function __construct($title=null, $name2=null, $name3=null, 
                                $route1=null, $route2=null, $route3=null, $id=null)
    {
        $this->title = $title;
        $this->name2 = $name2;
        $this->name3 = $name3;
        $this->route1 = $route1;
        $this->route2 = $route2;
        $this->route3 = $route3;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.breadcrumb');
    }
}
