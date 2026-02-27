<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{

    private function generateUserCode(string $role): string
    {
        $prefix = match ($role) {
            'admin'   => 'ADM',
            'leader'  => 'LEAD',
            'adviser' => 'AVD',
            'customer' => 'CUST',
            default   => 'USR',
        };

        // Get last user with same role
        $lastUser = User::where('role', $role)
            ->orderBy('id', 'desc')
            ->first();

        $number = 1;

        if ($lastUser && $lastUser->user_code) {
            preg_match('/\d+/', $lastUser->user_code, $matches);
            $number = isset($matches[0]) ? ((int)$matches[0] + 1) : 1;
        }

        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function store(Request $request)
{
    $request->validate([
        'buyer_name' => 'required',
        'mobile' => 'required',
        'email' => 'required|email|unique:users,email',
        'pan_number' => 'required',
        'aadhar_number' => 'required',
        'address' => 'required',
        'plot_number' => 'required',
    ]);

    $authUser = auth()->user(); // ✅ leader OR advisor

    $userCode = $this->generateUserCode('customer');

    try {

        $booking = DB::transaction(function () use ($request, $authUser, $userCode) {

            // ✅ Create Customer
            $newUser = User::create([
                'user_code' => $userCode,
                'name' => $request->buyer_name,
                'email' => $request->email,
                'password' => Hash::make('password'),
                'role' => 'customer',
                'contact_no' => $request->mobile,
                'city' => $request->city,
                'state' => $request->state,
                'address' => $request->address,
                'pin_code' => $request->pincode,
                'created_by' => $authUser->id
            ]);

            // ✅ Booking created by whoever logged in
            return Booking::create([
                'user_id' => $newUser->id,
                'user_code' => $authUser->user_code,
                'created_by' => $authUser->id,

                'buyer_name' => $request->buyer_name,
                'mobile' => $request->mobile,
                'dob' => $request->dob,
                'email' => $request->email,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'pan_number' => $request->pan_number,
                'aadhar_number' => $request->aadhar_number,
                'address' => $request->address,

                'advance_amount' => $request->advance_amount,
                'site_location' => $request->site_location,
                'commission_type' => $request->commission_type,
                'project_name' => $request->project_name,
                'plot_number' => $request->plot_number,
                'khasara_number' => $request->khasara_number,
                'ph_number' => $request->ph_number,
                'mouza' => $request->mouza,
                'tahsil' => $request->tahsil,
                'district' => $request->district,
                'square_feet' => $request->square_feet,
                'square_meter' => $request->square_meter,
                'total_booking_amount' => $request->total_booking_amount,
                'payment_mode' => $request->payment_mode,
                'remark' => $request->remark
            ]);
        });

        return response()->json([
            'status' => true,
            'message' => 'Booking created successfully',
            'data' => $booking
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'error' => $e->getMessage()
        ], 500);
    }
}
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Booking::with(['leader', 'location']);

        // 🔐 Role Based Filter
        if ($user->role !== 'admin') {
            $query->where('user_code', $user->user_code);
        }

        // 🔎 Search Filter
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('buyer_name', 'like', "%$search%")
                    ->orWhere('mobile', 'like', "%$search%")
                    ->orWhere('project_name', 'like', "%$search%")
                    ->orWhere('plot_number', 'like', "%$search%");
            });
        }

        // 📅 Date Filter
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [
                $request->from_date,
                $request->to_date
            ]);
        }

        // 📄 Pagination (default 10)
        $perPage = $request->per_page ?? 10;

        $bookings = $query->latest()->paginate($perPage);

        return response()->json([
            'status' => true,
            'data' => $bookings
        ]);
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
            'dob' => 'nullable|date',
            'email' => 'nullable|email',
            'pan_number' => 'nullable|string',
            'aadhar_number' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'pincode' => 'nullable|string',

            'advance_amount' => 'nullable|numeric',
            'commission_type' => 'nullable|string',
            'project_name' => 'nullable|string',
            'plot_number' => 'nullable|string',
            'khasara_number' => 'nullable|string',
            'ph_number' => 'nullable|string',
            'mouza' => 'nullable|string',
            'tahsil' => 'nullable|string',
            'district' => 'nullable|string',
            'square_feet' => 'nullable|string',
            'square_meter' => 'nullable|string',
            'total_booking_amount' => 'nullable|numeric',
            'payment_mode' => 'nullable|string',
            'remark' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update($request->only([
            'buyer_name',
            'mobile',
            'dob',
            'email',
            'pan_number',
            'aadhar_number',
            'address',
            'city',
            'state',
            'pincode',
            'advance_amount',
            'commission_type',
            'project_name',
            'plot_number',
            'khasara_number',
            'ph_number',
            'mouza',
            'tahsil',
            'district',
            'square_feet',
            'square_meter',
            'total_booking_amount',
            'payment_mode',
            'remark'
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

    public function dashboard()
    {
        $user = auth()->user();
        $query = Booking::query();
        // 🔹 If Admin → all advisers
        if ($user->role === 'admin') {

            $totalAdvisors = User::where('role', 'advisor')
                ->where('created_by', $user->id)
                ->count();
            $totalBookingAmount = Booking::sum('total_booking_amount');
            $totalCommissionAmount = 0;

            $bookings = $query->get();

            foreach ($bookings as $booking) {
                if ($booking->commission_type == 'amount') {
                    $totalCommissionAmount += $booking->total_booking_amount;
                } else if ($booking->commission_type == 'percent') {
                    $totalCommissionAmount += ($booking->advance_amount * $booking->total_booking_amount) / 100;
                }
            }
            $topAdvisor = Booking::select('user_code', DB::raw('SUM(advance_amount) as total'))
                ->groupBy('user_code')
                ->orderByDesc('total')
                ->first();
        }

        // 🔹 If Leader → advisers created by this leader
        elseif ($user->role === 'leader') {

            // Get adviser user_codes created by leader
            $adviserCodes = User::where('created_by', $user->id)
                ->where('role', 'adviser')
                ->pluck('user_code');

            $totalAdvisors = $adviserCodes->count();

            $totalBookingAmount = Booking::whereIn('user_code', $adviserCodes)
                ->sum('advance_amount');

            $totalCommissionAmount = Booking::whereIn('user_code', $adviserCodes)
                ->sum('total_booking_amount');

            $topAdvisor = Booking::whereIn('user_code', $adviserCodes)
                ->select('user_code', DB::raw('SUM(total_booking_amount) as total'))
                ->groupBy('user_code')
                ->orderByDesc('total')
                ->first();
        }

        // 🔹 If Adviser → only his own
        else {

            $totalAdvisors = 1;

            $totalBookingAmount = Booking::where('user_code', $user->user_code)
                ->sum('advance_amount');

            $totalCommissionAmount = Booking::where('user_code', $user->user_code)
                ->sum('commission_amt');

            $topAdvisor = Booking::where('user_code', $user->user_code)
                ->select('user_code', DB::raw('SUM(advance_amount) as total'))
                ->groupBy('user_code')
                ->first();
        }

        return response()->json([
            'total_advisors' => $totalAdvisors,
            'total_booking_amount' => $totalBookingAmount,
            'total_commission_amount' => $totalCommissionAmount,
            'top_advisor' => $topAdvisor?->user_code
        ]);
    }

    public function adviserPerformance(Request $request)
    {
        $leader = auth()->user();

        if ($leader->role !== 'leader') {
            return response()->json([
                'status' => false,
                'message' => 'Only leader can view this'
            ], 403);
        }

        $perPage = $request->per_page ?? 10;

        $advisers = User::where('created_by', $leader->id)
            ->where('role', 'adviser')
            ->withCount(['bookings as total_deals'])
            ->withSum('bookings as total_booking_amount', 'advance_amount')
            ->orderByDesc('total_booking_amount')
            ->paginate($perPage);

        return response()->json([
            'status' => true,
            'data' => $advisers
        ]);
    }
}
