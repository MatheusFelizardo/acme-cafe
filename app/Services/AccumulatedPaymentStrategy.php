<?php
namespace App\Services;

class AccumulatedPaymentStrategy implements VoucherStrategy {
    public function apply_discount($amount) {
        return $amount * 0.95;
    }
}