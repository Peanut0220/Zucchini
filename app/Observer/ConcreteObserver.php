<?php

namespace App\Observer;

use Livewire\Component; // Import Livewire Component for reference if needed

class ConcreteObserver implements Observer
{
    private $observerState;

    public function update($deliveryStatus)
    {
        $this->observerState = $deliveryStatus;
        $this->refreshOrderPage();
    }

    private function refreshOrderPage()
    {
        // Emit WebSocket or event that Livewire listens to using a different method.
        // Livewire::emit() does not work statically, so we need to ensure we send the event properly.

        // Instead of calling Livewire::emit statically, we can use an event dispatch system
        // which can be caught by Livewire's component.
        event(new \App\Events\OrderUpdated($this->observerState));
    }
}
