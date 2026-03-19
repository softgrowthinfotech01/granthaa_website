<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingPayment;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingPaymentController extends Controller
{
    // ✅ Store Payment
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:1',
            'payment_mode' => 'required',
        ]);

        try {

            $user = auth()->user();

            $booking = Booking::findOrFail($request->booking_id);

            $payment = BookingPayment::create([
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id, // ✅ customer
                'received_by' => $user->id,     // ✅ adviser/leader
                'amount' => $request->amount,
                'payment_type' => $request->payment_type,
                'payment_mode' => $request->payment_mode,
                'remark' => $request->remark ?? 'Customer payment'
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Payment added successfully',
                'data' => $payment
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ✅ Get payments by booking
    public function getByBooking($bookingId)
    {
        try {

            $payments = BookingPayment::where('booking_id', $bookingId)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $payments
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    // ✅ Get all payments (for admin)
    public function index()
    {
        $payments = BookingPayment::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $payments
        ]);
    }

    public function myPayments()
{
    $user = auth()->user();

    try {

        // ===============================
        // 👑 LEADER
        // ===============================
        if ($user->role == 'leader') {

            $teamIds = \App\Models\User::where('created_by', $user->id)
                ->pluck('id')
                ->push($user->id);

            $payments = \App\Models\BookingPayment::whereIn('received_by', $teamIds)
                ->with('booking')
                ->latest()
                ->get();

            return response()->json([
                'status' => true,
                'role' => 'leader',
                'total_received' => $payments->sum('amount'),
                'data' => $payments
            ]);
        }

        // ===============================
        // 🧑‍💼 ADVISER
        // ===============================
        if ($user->role == 'adviser') {

            $payments = \App\Models\BookingPayment::where('received_by', $user->id)
                ->with('booking')
                ->latest()
                ->get();

            return response()->json([
                'status' => true,
                'role' => 'adviser',
                'total_received' => $payments->sum('amount'),
                'data' => $payments
            ]);
        }

        // ===============================
        // 👤 CUSTOMER
        // ===============================
        if ($user->role == 'customer') {

            $bookings = \App\Models\Booking::where('user_code', $user->user_code)->get();

            $result = [];

            foreach ($bookings as $booking) {

                $payments = \App\Models\BookingPayment::where('booking_id', $booking->id)->get();

                $totalPaid = $payments->sum('amount');

                $result[] = [
                    'booking_id' => $booking->id,
                    'plot_number' => $booking->plot_number,
                    'total_amount' => $booking->total_booking_amount,
                    'paid_amount' => $totalPaid,
                    'balance_amount' => $booking->total_booking_amount - $totalPaid,
                    'payments' => $payments
                ];
            }

            return response()->json([
                'status' => true,
                'role' => 'customer',
                'data' => $result
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid role'
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'error' => $e->getMessage()
        ]);
    }
}



    // booking payment fetch the balance and total and paid amount
    public function getBookingSummary($id)
{
    $booking = Booking::findOrFail($id);

    $totalPaid = BookingPayment::where('booking_id', $id)->sum('amount');

    return response()->json([
        'total_amount' => $booking->total_booking_amount,
        'paid_amount' => $totalPaid,
        'balance' => $booking->total_booking_amount - $totalPaid
    ]);
}
}