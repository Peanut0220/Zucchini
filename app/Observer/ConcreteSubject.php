<?php

// app/Observer/ConcreteSubject.php

namespace App\Observer;

class ConcreteSubject implements Subject
{
    private $state;
    private $observers = [];

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        $index = array_search($observer, $this->observers);
        if ($index !== false) {
            unset($this->observers[$index]);
        }
    }

    // Updated setState to accept two parameters
    public function setState($deliveryStatus, $deliveryId)
    {
        $this->state = $deliveryStatus;

        // Notify observers, passing the delivery ID as well
        $this->notify($deliveryStatus, $deliveryId);
    }

    public function notify($deliveryStatus, $deliveryId)
    {
        foreach ($this->observers as $observer) {
            $observer->update($deliveryStatus, $deliveryId);
        }
    }
}

