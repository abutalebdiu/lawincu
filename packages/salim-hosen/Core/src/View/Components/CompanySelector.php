<?php

namespace SalimHosen\Core\View\Components;

use Illuminate\View\Component;

class CompanySelector extends Component
{

    public $companies, $defaultCompany;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->companies = \Auth::user()->companies;
        $this->defaultCompany = \Auth::user()->companies()->find(session("company"));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('core::components.company-selector');
    }
}
