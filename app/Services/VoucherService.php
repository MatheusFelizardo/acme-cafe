<?php

namespace App\Services;

use App\Models\Voucher;



class VoucherService
{
  public function generate_accumulated_payment_voucher() {
    $code = 'AP'. strtoupper(bin2hex(random_bytes(3))) . date("Y");
    $voucher_exists = Voucher::where('code', $code)->first();
    if ($voucher_exists) {
      return $this->generate_accumulated_payment_voucher();
    }

    $voucher = new Voucher();

    $voucher->code = $code;
    $voucher->discount = 0.05;
    $voucher->expires_at = now()->addDays(365);
    $voucher->is_active = true;
    $voucher->type = 'accumulated_payment';
    $voucher->save();
    return $voucher;
  }

  public function generate_free_coffee_voucher() {
    $code = 'CF'. strtoupper(bin2hex(random_bytes(3))) . date("Y");
    $voucher_exists = Voucher::where('code', $code)->first();

    if ($voucher_exists) {
      return $this->generate_free_coffee_voucher();
    }

    $voucher = new Voucher();
    $voucher->code = $code;
    $voucher->discount = 1;
    $voucher->expires_at = now()->addDays(365);
    $voucher->is_active = true;
    $voucher->type = 'free_coffee';
    $voucher->save();
    return $voucher;
  }

  public function invalidate_voucher($code) {
    $voucher = Voucher::where('code', $code)->first();
    if ($voucher) {
      $voucher->is_active = false;
      $voucher->save();
    }
  }

  public function get_voucher($code) {
    return Voucher::where('code', $code)->first();
  }

  public function get_vouchers() {
    $vouchers = Voucher::with('users')->get();
    return  $vouchers;
  }

  public function reactivate_voucher($code) {
    $voucher = Voucher::where('code', $code)->first();
    if ($voucher) {
      $voucher->is_active = true;
      $voucher->save();
    }
  }

  public function check_date_validation($code) {
    $voucher = Voucher::where('code', $code)->first();
    if ($voucher) {
      return $voucher->expires_at > now();
    }
    return false;
  }

  public function get_user_vouchers($userId) {
    return Voucher::where('user_id', $userId)->get();
  }
}