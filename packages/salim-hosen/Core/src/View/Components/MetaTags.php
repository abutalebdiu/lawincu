<?php

namespace SalimHosen\Core\View\Components;

use Illuminate\View\Component;
use SalimHosen\Website\Models\Page;

class MetaTags extends Component
{

    public $page;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $path = request()->path() == "/" ? null : request()->path();
        $this->page = Page::where("url", $path)->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('core::components.meta-tags');
    }
}
