<?php
//Author: Shi Lei
namespace App\Strategy;


class EwalletPayment implements PaymentMethodInterface {
    public function pay($amount) {
        // Implement cash payment logic
        return "Paid $amount via Ewallet.";
    }
}
