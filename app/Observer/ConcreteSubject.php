<?php

namespace App\Observer;

use App\Observer\Subject;
use App\Observer\Observer;

class ConcreteSubject implements Subject
{
    private $observers = [];
    private $deliveryStatus;

    public function getState()
    {
        return $this->deliveryStatus;
    }

    public function setState($status)
    {
        $this->deliveryStatus = $status;
        $this->notify();
    }

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        foreach ($this->observers as $key => $o) {
            if ($o === $observer) {
                unset($this->observers[$key]);
            }
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->getState());
        }
    }
}
