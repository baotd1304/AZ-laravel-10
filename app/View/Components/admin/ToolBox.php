<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ToolBox extends Component
{
    public $tableHeading;
    public $model;

    public function __construct($tableHeading= null, $model=null)
    {
        $this->tableHeading = $tableHeading;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.tool-box');
    }
}
