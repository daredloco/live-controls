<?php

namespace Helvetiapps\LiveControls\Objects\Financial;

use Carbon\Carbon;

class Cashflow{
    public array $profits = [];
    public array $expenses = [];

    public function __construct(array $data = [])
    {
        if(count($data) == 2){
            foreach($data["profits"] as $arr){
                $profit = new CashflowItem(
                    $arr["documentNumber"],
                    $arr["name"],
                    $arr["description"],
                    $arr["from"],
                    $arr["value_in_cents"],
                    $arr["value_paid_in_cents"],
                    $arr["referenceDate"],
                    $arr["dueDate"],
                    $arr["paidDate"]
                );
                array_push($this->profits, $profit);
            }
            foreach($data["expenses"] as $arr){
                $expense = new CashflowItem(
                    $arr["documentNumber"],
                    $arr["name"],
                    $arr["description"],
                    $arr["from"],
                    $arr["value_in_cents"],
                    $arr["value_paid_in_cents"],
                    $arr["referenceDate"],
                    $arr["dueDate"],
                    $arr["paidDate"]
                );
                array_push($this->expenses, $expense);
            }
        }
    }

    public function addProfit(string $documentNumber, string $name, string $description, string $from, int $value_in_cents, int $value_paid_in_cents, Carbon $referenceDate, Carbon $dueDate, Carbon $paidDate)
    {
        $profit = new CashflowItem(
            $documentNumber,
            $name,
            $description,
            $from,
            $value_in_cents,
            $value_paid_in_cents,
            $referenceDate,
            $dueDate,
            $paidDate
        );

        array_push($this->profits, $profit);
    }

    public function addExpense(string $documentNumber, string $name, string $description, string $from, int $value_in_cents, int $value_paid_in_cents, Carbon $referenceDate, Carbon $dueDate, Carbon $paidDate)
    {
        $expense = new CashflowItem(
            $documentNumber,
            $name,
            $description,
            $from,
            $value_in_cents,
            $value_paid_in_cents,
            $referenceDate,
            $dueDate,
            $paidDate
        );

        array_push($this->expenses, $expense);
    }

    public function getProfits(Carbon $from = null, Carbon $to = null): array{
        $profits = [];
        if(is_null($from) && is_null($to)){
            return $this->profits;
        }
        foreach($this->profits as $profit)
        {
            if($profit->dueDate->between($from, $to)){
                array_push($profits, $profit);
            }
        }
        return $profits;
    }

    public function getExpenses(Carbon $from = null, Carbon $to = null): array{
        $expenses = [];
        if(is_null($from) && is_null($to)){
            return $this->expenses;
        }
        foreach($this->expenses as $expense)
        {
            if($expense->dueDate->between($from, $to)){
                array_push($expenses, $expense);
            }
        }
        return $expenses;
    }

    public function getPaidProfits(): array{
        $profits = [];
        foreach($this->profits as $profit){
            if($profit->isPaid())
            {
                array_push($profits, $profit);
            }
        }
        return $profits;
    }

    public function getPaidExpenses(): array{
        $expenses = [];
        foreach($this->expenses as $expense){
            if($expense->isPaid())
            {
                array_push($expenses, $expense);
            }
        }
        return $expenses;
    }

    public function getUnpaidProfits(): array{
        $profits = [];
        foreach($this->profits as $profit){
            if(!$profit->isPaid())
            {
                array_push($profits, $profit);
            }
        }
        return $profits;
    }

    public function getUnpaidExpenses(): array{
        $expenses = [];
        foreach($this->expenses as $expense){
            if($expense->isPaid())
            {
                array_push($expenses, $expense);
            }
        }
        return $expenses;
    }

    public function getSaldo():int{
        $saldo = 0;
        foreach($this->profits as $profit){
            $saldo += $profit->value_in_cents;
        }
        foreach($this->expenses as $expense){
            $saldo -= $expense->value_in_cents;
        }
        return $saldo;
    }

    public function getPaidSaldo():int{
        $saldo = 0;
        foreach($this->profits as $profit){
            $saldo += $profit->value_paid_in_cents;
        }
        foreach($this->expenses as $expense){
            $saldo -= $expense->value_paid_in_cents;
        }
        return $saldo;
    }

    public function getSaldoBetween(Carbon $from, Carbon $to):int
    {
        $saldo = 0;
        foreach($this->profits as $profit)
        {
            if($profit->dueDate->between($from,$to))
            {
                $saldo += $profit->value_in_cents;
            }
        }
        foreach($this->expenses as $expense)
        {
            if($expense->dueDate->between($from,$to))
            {
                $saldo -= $expense->value_in_cents;
            }
        }
        return $saldo;
    }

    public function getPaidSaldoBetween(Carbon $from, Carbon $to):int
    {
        $saldo = 0;
        foreach($this->profits as $profit)
        {
            if($profit->paidDate->between($from,$to))
            {
                $saldo += $profit->value_paid_in_cents;
            }
        }
        foreach($this->expenses as $expense)
        {
            if($expense->paidDate->between($from,$to))
            {
                $saldo -= $expense->value_paid_in_cents;
            }
        }
        return $saldo;
    }
}