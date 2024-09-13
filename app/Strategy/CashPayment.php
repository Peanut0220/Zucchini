<?php

namespace App\Strategy;


class CashPayment implements PaymentMethodInterface {
    public function pay($amount) {
        // Implement cash payment logic
        return "Paid $amount via Cash On Delivery.";
    }
}
