<?php

namespace App\Observer;

use App\Observer\Observer;

interface Subject
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify($deliveryStatus, $deliveryId);
}
