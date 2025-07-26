<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Table;

class TableCard extends Component
{
    public Table $table;

    /**
     * Create a new component instance.
     */
    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table-card');
    }
}
