<?php

namespace App\View\Components;

use Closure;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReservationCard extends Component
{
    public Reservation $reservation;

    /**
     * Create a new component instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reservation-card');
    }
}
