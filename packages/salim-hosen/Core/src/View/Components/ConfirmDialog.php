<?php

namespace SalimHosen\Core\View\Components;

use Illuminate\View\Component;

class ConfirmDialog extends Component
{

    public $id, $action;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $action)
    {
        $this->action = $action;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('core::components.confirm-dialog');
    }
}
