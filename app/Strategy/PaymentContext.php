<?php

namespace App\Strategy;

class PaymentContext {
    private $paymentMethod = NULL;

    public function __construct($payment_method_id) {
        switch ($payment_method_id) {
            case "COD":
                $this->paymentMethod = new CashPayment();
                break;
            case "CC":
                $this->paymentMethod = new CardPayment();
                break;
            case "EW":
                $this->paymentMethod = new EwalletPayment();
                break;

        }
    }

    public function processPayment($amount) {
        return $this->paymentMethod->pay($amount);
    }
}
