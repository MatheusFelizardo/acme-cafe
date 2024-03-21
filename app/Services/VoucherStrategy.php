<?php
namespace App\Services;

interface VoucherStrategy {
  public function apply_discount($amount);
}