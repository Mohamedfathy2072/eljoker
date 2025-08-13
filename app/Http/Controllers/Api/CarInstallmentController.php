<?php

namespace App\Http\Controllers\Api;

use App\Helpers\CarInstallmentCalculator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarInstallmentController extends Controller
{
    public function calculateInstallment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_price' => 'required|numeric|min:1',
            'down_payment' => 'required|numeric|min:0',
            'months' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        $calculator = new CarInstallmentCalculator(
            $request->car_price,
            $request->down_payment,
            $request->months,
        );

        $result = $calculator->calculate();
        return response()->json($result);
    }
}
