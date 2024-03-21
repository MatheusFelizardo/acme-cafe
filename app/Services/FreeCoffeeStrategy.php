<?php
namespace App\Services;

class FreeCoffeeStrategy implements VoucherStrategy {
    const COFFE_DISH_NAME = 'Espresso';
    const COFFE_PRICE = 2.5;

    public function apply_discount($amount) {
        $final_amount = $amount;
        $order = $this->order;
        $order_items = $order->items;
        $has_coffee = $order_items->filter(function($item) {
            return $item->dish->name == $this::COFFE_DISH_NAME;
        })->first();

        if ($has_coffee) {
          $final_amount -= $this::COFFE_PRICE;
        }
        
        return $final_amount;
    }
}