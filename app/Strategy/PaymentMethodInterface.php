<?php
//Author: Shi Lei
namespace App\Strategy;

interface PaymentMethodInterface {
    public function pay($amount);
}
