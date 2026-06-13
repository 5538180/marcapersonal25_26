<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // El shell Tailwind de Breeze (dashboard y perfil) se mantiene en
        // su propia vista para no chocar con el layout público de Dopetrope.
        return view('layouts.breeze-app');
    }
}
