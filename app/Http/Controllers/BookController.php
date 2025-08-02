<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function makeAppointment(Request $request)
    {
        $request->validate([
            'car_id' => 'required|integer|exists:cars,id',
            'user_id' => 'required|integer|exists:users,id',
            'address' => 'required|string',
            'appointment_date' => 'required|date|after:now',
            'appointment_time' => 'required|date_format:H:i',
        ]);
        return Book::create([
            'car_id' => $request->car_id,
            'user_id' => $request->user_id,
            'address' => $request->address,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);
    }
}
