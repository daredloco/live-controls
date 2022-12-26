<?php

namespace Helvetiapps\LiveControls\Objects\Payments\PagSeguro;

class PaymentItem{
    public readonly string $id;
    public readonly string $name;
    public readonly float $amount;
    public readonly int $quantity;
    public readonly float $weigth;
    public readonly float $shippingCost;

    public function __construct(string $id, string $name, float|int $amount, int $quantity, float|int $weight, float|int $shippingCost)
    {
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
        $this->quantity = $quantity;
        $this->weight = $weight;
        $this->shippingCost = $shippingCost;
    }
}