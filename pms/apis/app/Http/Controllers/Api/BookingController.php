<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'buyer_name' => 'required',
            'mobile' => 'required',
            'pan_number' => 'required',
            'aadhar_number' => 'required',
            'address' => 'required',
            'plot_number' => 'required',
        ]);
        // print_r(auth()->id());exit;
        $booking = Booking::create([
            'user_code' => auth()->id(), // auto from logged user
            ...$request->all()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Booking Created Successfully',
            'data' => $booking
        ]);
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $bookings = Booking::with('leader')->latest()->get();
        } else {
            $bookings = Booking::where('user_code', $user->id)->latest()->get();
        }

        return response()->json($bookings);
    }

    public function show($id)
    {
        $booking = Booking::with('leader')->findOrFail($id);

        return response()->json($booking);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'buyer_name' => 'sometimes|required|string',
            'mobile' => 'sometimes|required|string',
            'pan_number' => 'sometimes|required|string',
            'aadhar_number' => 'sometimes|required|string',
            'address' => 'sometimes|required|string',
            'plot_number' => 'sometimes|required|string',
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update($request->only([
            'buyer_name',
            'mobile',
            'pan_number',
            'aadhar_number',
            'address',
            'plot_number'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Booking Updated Successfully',
            'data' => $booking
        ]);
    }

    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Booking Deleted'
        ]);
    }
}
