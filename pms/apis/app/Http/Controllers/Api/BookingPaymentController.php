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
        $payments = Booking::with(['leader', 'location'])
            ->withSum('payments as paid_amount', 'amount');

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

                $bookings = Booking::whereIn('created_by', $teamIds)->get();

                $result = [];

                foreach ($bookings as $booking) {

                    // ✅ ONLY TEAM PAYMENTS
                    $payments = BookingPayment::where('booking_id', $booking->id)
                        ->whereIn('received_by', $teamIds)
                        ->get();

                    $totalPaid = $payments->sum('amount');

                    $result[] = [
                        'booking_id' => $booking->id,
                        'buyer_name' => $booking->buyer_name,
                        'project_name' => $booking->project_name,
                        'plot_number' => $booking->plot_number,
                        'total_amount' => $booking->total_booking_amount,
                        'paid_amount' => $totalPaid,
                        'balance_amount' => $booking->total_booking_amount - $totalPaid,
                        'payments' => $payments
                    ];
                }

                return response()->json([
                    'status' => true,
                    'role' => 'leader',
                    'data' => $result
                ]);
            }

            // ===============================
            // 🧑‍💼 ADVISER
            // ===============================
            if ($user->role == 'adviser') {

                $bookings = Booking::where('created_by', $user->id)->get();

                $result = [];

                foreach ($bookings as $booking) {

                    // ✅ ONLY HIS PAYMENTS
                    $payments = BookingPayment::where('booking_id', $booking->id)
                        ->where('received_by', $user->id)
                        ->get();

                    $totalPaid = $payments->sum('amount');

                    $result[] = [
                        'booking_id' => $booking->id,
                        'buyer_name' => $booking->buyer_name,
                        'project_name' => $booking->project_name,
                        'plot_number' => $booking->plot_number,
                        'total_amount' => $booking->total_booking_amount,
                        'paid_amount' => $totalPaid,
                        'balance_amount' => $booking->total_booking_amount - $totalPaid,
                        'payments' => $payments
                    ];
                }

                return response()->json([
                    'status' => true,
                    'role' => 'adviser',
                    'data' => $result
                ]);
            }

            // ===============================
            // 👤 CUSTOMER
            // ===============================
            if ($user->role == 'customer') {

                $bookings = Booking::where('user_code', $user->user_code)->get();

                $result = [];

                foreach ($bookings as $booking) {

                    // ✅ ONLY HIS PAYMENTS
                    $payments = BookingPayment::where('booking_id', $booking->id)
                        ->where('user_id', $user->id)
                        ->get();

                    $totalPaid = $payments->sum('amount');

                    $result[] = [
                        'booking_id' => $booking->id,
                        'buyer_name' => $booking->buyer_name,
                        'project_name' => $booking->project_name,
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
