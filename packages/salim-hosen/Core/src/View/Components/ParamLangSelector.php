<?php

namespace SalimHosen\Core\View\Components;

use Illuminate\View\Component;

class ParamLangSelector extends Component
{

    public $languages, $default_language, $url, $host;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->languages = \SalimHosen\Core\Models\Language::where('is_active', true)->get();
        $this->default_language = \SalimHosen\Core\Models\Language::where('code', app()->getLocale())->first();
        $this->url = url()->full();
        $this->host = request()->getSchemeAndHttpHost();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('core::components.param-lang-selector');
    }
}
