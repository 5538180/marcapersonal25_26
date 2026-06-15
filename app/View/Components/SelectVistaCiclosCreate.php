<?php

namespace App\View\Components;

use App\Models\FamiliaProfesional;
use Illuminate\View\Component;
use Illuminate\View\View;

class SelectVistaCiclosCreate extends Component
{
    public $familias;

    public function __construct()
    {
        $this->familias = FamiliaProfesional::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.select-vista-ciclos-create');
    }
}
