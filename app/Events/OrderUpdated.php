<?php

namespace App\Events;

class OrderUpdated
{
    public $status;

    public function __construct($status)
    {
        $this->status = $status;
    }
}
