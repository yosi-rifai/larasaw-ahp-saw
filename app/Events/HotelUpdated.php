<?php

namespace App\Events;

use App\Models\Hotel;
use Illuminate\Queue\SerializesModels;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class HotelUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $hotel;

    public function __construct(Hotel $hotel)
    {
        $this->hotel = $hotel;
    }
}
