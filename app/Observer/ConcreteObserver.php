<?php

namespace App\Observer;

use App\Events\OrderUpdated;

class ConcreteObserver implements Observer
{
    private $observerState;

    public function update($deliveryStatus, $deliveryId)
    {
        $this->observerState = $deliveryStatus;
        $this->notifyFrontend($deliveryId);
    }

    private function notifyFrontend($deliveryId)
    {
        // Emit the event to notify the frontend (orderShow page) about the updated status
        event(new OrderUpdated($status, $updated_at, $delivery_id));
    }
}
