<?php

namespace Helvetiapps\LiveControls\Objects\Financial;

use Carbon\Carbon;

class CashflowItem
{
    public readonly string $documentNumber;
    public readonly string $name;
    public readonly string $description;
    public readonly string $from;
    public readonly int $value_in_cents;
    public readonly int $value_paid_in_cents;
    public readonly Carbon $referenceDate;
    public readonly Carbon $dueDate;
    public readonly Carbon $paidDate;

    public function __construct(string $documentNumber, string $name, string $description, string $from, int $value_in_cents, int $value_paid_in_cents, Carbon $referenceDate, Carbon $dueDate, Carbon $paidDate)
    {
        $this->documentNumber = $documentNumber;
        $this->name = $name;
        $this->description = $description;
        $this->from = $from;
        $this->value_in_cents = $value_in_cents;
        $this->value_paid_in_cents = $value_paid_in_cents;
        $this->referenceDate = $referenceDate;
        $this->dueDate = $dueDate;
        $this->paidDate = $paidDate;
    }

    public function isPaid(): bool{
        return $this->paidDate != null;
    }
}