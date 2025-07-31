<?php

namespace App\Helpers;

class CarPriceCalculator
{
    protected float $monthInstallment;
    protected float $downPayment;
    protected int $months;
    protected float $annualInterest = 15;

    public function __construct(float $monthInstallment, float $downPayment, int $months)
    {
        $this->monthInstallment = $monthInstallment;
        $this->downPayment = $downPayment;
        $this->months = $months;
    }

    public function calculate(): array
    {
        // Reverse Calculation
        $years = $this->months / 12;
        $interestPercent = $years * $this->annualInterest;
        $totalToPay = $this->monthInstallment * $this->months;

        // Reverse the interest formula to get loan amount
        $loanAmount = $totalToPay / (1 + ($interestPercent / 100));
        $interestAmount = $totalToPay - $loanAmount;
        $carPrice = $loanAmount + $this->downPayment;

        return [
            'monthly_installment' => round($this->monthInstallment, 2),
            'down_payment' => $this->downPayment,
            'loan_amount' => round($loanAmount, 2),
            'interest_percent' => $interestPercent,
            'interest_amount' => round($interestAmount, 2),
            'total_to_pay' => round($totalToPay, 2),
            'car_price' => round($carPrice, 2),
        ];
    }
}
