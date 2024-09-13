<?php

namespace App\Strategy;


class CardPayment implements PaymentMethodInterface {
    public function pay($amount) {
        // Implement Card payment logic
        return "Paid $amount via Card payment.";
    }
}
