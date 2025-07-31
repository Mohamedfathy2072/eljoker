<?php

namespace App\Http\Controllers;

use App\Helpers\CarInstallmentCalculator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarInstallmentController extends Controller
{
    public function calculateInstallment(Request $request)
    {
        $request->validate([
            'car_price' => 'required|numeric|min:1',
            'down_payment' => 'required|numeric|min:0',
            'months' => 'required|integer|min:1',
        ]);

        $calculator = new CarInstallmentCalculator(
            $request->car_price,
            $request->down_payment,
            $request->months
        );

        $result = $calculator->calculate();

        return response()->json($result);
    }
}
