<?php

namespace Helvetiapps\LiveControls\Objects\Financial;

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

    public function getSaldo():int{
        $saldo = 0;
        foreach($this->profits as $profit){
            $saldo += $profit->value_in_cents;
        }
        foreach($this->expenses as $expense){
            $saldo += $expense->value_in_cents;
        }
        return $saldo;
    }

    public function getPaidSaldo():int{
        $saldo = 0;
        foreach($this->profits as $profit){
            $saldo += $profit->value_paid_in_cents;
        }
        foreach($this->expenses as $expense){
            $saldo += $expense->value_paid_in_cents;
        }
        return $saldo;
    }
}