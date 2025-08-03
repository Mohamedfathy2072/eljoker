<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Http\Resources\CarResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function makeAppointment(Request $request)
    {
        $request->validate([
            'car_id' => 'required|integer|exists:cars,id',
            'address' => 'nullable|string',
            'appointment_date' => 'required|date|after:now',
            'appointment_time' => 'required|date_format:H:i',
        ]);
        return Book::create([
            'car_id' => $request->car_id,
            'user_id' => auth()->user()->id,
            'address' => $request->address ?? '-',
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);
    }

    public function getBookedCars()
    {
        $books = Book::with('car')->where('user_id', auth()->id())->get();

        return response()->json([
            'message' => 'Booked cars fetched successfully.',
            'data' => BookResource::collection($books)
        ]);
    }
}
