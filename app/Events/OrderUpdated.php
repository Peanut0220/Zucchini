<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderUpdated implements ShouldBroadcast
{
    public $status;
    public $updated_at;
    public $delivery_id; // Add this property

    public function __construct($status, $updated_at, $delivery_id) // Add $delivery_id as a parameter
    {
        $this->status = $status;
        $this->updated_at = $updated_at;
        $this->delivery_id = $delivery_id; // Assign it to the property
    }

    public function broadcastOn()
    {
        return new Channel('delivery-status.' . $this->delivery_id); // Now it will work
    }
}

