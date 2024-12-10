<?php 
// app/Http/Controllers/BookingController.php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // View a booking
    public function view($id)
    {
        $booking = Booking::findOrFail($id);
        return response()->json($booking);
    }

    // Create a new booking
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'status' => 'required|in:confirmed,pending,cancelled',
        ]);

        $booking = Booking::create($validatedData);

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking,
        ], 201);
    }

    // Edit an existing booking
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'status' => 'required|in:confirmed,pending,cancelled',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($validatedData);

        return response()->json([
            'message' => 'Booking updated successfully',
            'booking' => $booking,
        ]);
    }
}

