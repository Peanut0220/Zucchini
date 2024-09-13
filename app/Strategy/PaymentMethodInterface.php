<?php

namespace App\Strategy;

interface PaymentMethodInterface {
    public function pay($amount);
}
