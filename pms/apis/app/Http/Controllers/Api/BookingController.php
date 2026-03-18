<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CommissionLedger;
use App\Models\LocationMaster;
use App\Models\Referral;
use App\Models\User;
use App\Models\UserLocationCommission;
use App\Models\WalletTransaction;
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
            'mobile' => 'required|digits:10',
            'email' => 'required|email',
            'pan_number' => 'required',
            'aadhar_number' => 'required|digits:12',
            'address' => 'required',
            'plot_number' => 'required',
            'site_location' => 'required|exists:location_master,id',
            'commission_type' => 'required',
            'commission_value' => 'required',
            'referral_id' => 'nullable|exists:referrals,id',
        ]);


        $leader = auth()->user();
        $userCode = $this->generateUserCode('customer');
        // print_r($userCode);exit;
        try {

            $booking = DB::transaction(function () use ($request, $leader, $userCode) {

                $commissionValue = (float) str_replace(['₹', ',', ' '], '', $request->commission_value);
                $totalBookingAmount = (float) str_replace(['₹', ',', ' '], '', $request->total_booking_amount);

                $commissionAmount = 0;

                if ($request->commission_type === "percent") {
                    $commissionAmount = ($totalBookingAmount * $commissionValue) / 100;
                } elseif ($request->commission_type === "amount") {
                    $commissionAmount = $commissionValue;
                }

                $commission_amount = round($commissionAmount, 2);

                $newUser = User::where('email', $request->email)->first();
                if (!$newUser) {
                    $newUser = User::create([
                        'user_code' => $userCode,
                        'name' => $request->buyer_name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password ?? 'password'),
                        'role' => 'customer',
                        'contact_no' => $request->mobile,
                        'city' => $request->city,
                        'state' => $request->state,
                        'address' => $request->address,
                        'pin_code' => $request->pincode,
                        'created_by' => $leader->id
                    ]);
                }

                $creator = auth()->user();
                // print_r($creator->role);exit;             
                $leaderId = null;
                $adviserId = null;

                $leaderCommissionType = null;
                $leaderCommissionValue = 0;
                $leaderCommissionAmount = 0;

                $adviserCommissionType = null;
                $adviserCommissionValue = 0;
                $adviserCommissionAmount = 0;

                if ($creator->role == 'leader') {

                    $leaderId = $creator->id;
                    // print_r($leaderId);exit;
                    $leaderCommissionType = $request->commission_type;
                    $leaderCommissionValue = $commissionValue;
                    $leaderCommissionAmount = $commission_amount;
                    // print_r($leaderCommissionAmount);exit;

                }

                if ($creator->role == 'adviser') {

                    $adviserId = $creator->id;
                    $leaderId = $creator->created_by;

                    // Admin -> Leader commission
                    $leaderCommission = UserLocationCommission::where('user_id', $leaderId)
                        ->where('location_id', $request->site_location)
                        ->first();

                    if (!$leaderCommission) {
                        throw new \Exception("Leader commission not configured for this location.");
                    }

                    // Leader -> Adviser commission
                    $adviserCommission = UserLocationCommission::where('user_id', $adviserId)
                        ->where('location_id', $request->site_location)
                        ->first();

                    if (!$adviserCommission) {
                        throw new \Exception("Adviser commission not configured for this location.");
                    }

                    // Leader commission calculation
                    if ($leaderCommission->commission_type == 'percent') {
                        $leaderAmount = ($totalBookingAmount * $leaderCommission->commission_value) / 100;
                    } else {
                        $leaderAmount = $leaderCommission->commission_value;
                    }

                    // Adviser commission calculation
                    if ($adviserCommission->commission_type == 'percent') {
                        $adviserAmount = ($totalBookingAmount * $adviserCommission->commission_value) / 100;
                    } else {
                        $adviserAmount = $adviserCommission->commission_value;
                    }

                    // Validation
                    if ($adviserAmount > $leaderAmount) {
                        throw new \Exception("Adviser commission cannot exceed leader commission.");
                    }

                    $leaderCommissionAmount = $leaderAmount - $adviserAmount;
                    $adviserCommissionAmount = $adviserAmount;

                    $leaderCommissionType = $leaderCommission->commission_type;
                    $leaderCommissionValue = $leaderCommission->commission_value;

                    $adviserCommissionType = $adviserCommission->commission_type;
                    $adviserCommissionValue = $adviserCommission->commission_value;

                    $commission_amount = round($leaderAmount, 2);
                    $commission_type = $leaderCommission->commission_type;
                    $commissionValue = $leaderCommission->commission_value;
                    

                }

                // 2️⃣ Create Booking
                $booking = Booking::create([
                    'user_id' => $newUser->id,
                    'user_code' => $leader->user_code,

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

                    'created_by' => $creator->id,
                    'created_by_role' => $creator->role,

                    'leader_id' => $leaderId,
                    'adviser_id' => $adviserId,

                    'leader_commission_type' => $leaderCommissionType,
                    'leader_commission_value' => $leaderCommissionValue,
                    'leader_commission_amount' => $leaderCommissionAmount,

                    'adviser_commission_type' => $adviserCommissionType,
                    'adviser_commission_value' => $adviserCommissionValue,
                    'adviser_commission_amount' => $adviserCommissionAmount,

                    'advance_amount' => $request->advance_amount,
                    'site_location' => $request->site_location,
                    'commission_value' => $commissionValue,
                    'commission_amount' => $commission_amount,
                    'commission_type' => $request->commission_type ? $request->commission_type : $commission_type,

                    'project_name' => $request->project_name,
                    'plot_number' => $request->plot_number,
                    'khasara_number' => $request->khasara_number,
                    'ph_number' => $request->ph_number,
                    'mouza' => $request->mouza,
                    'tahsil' => $request->tahsil,
                    'district' => $request->district,

                    'square_feet' => $request->square_feet,
                    'square_meter' => $request->square_meter,

                    'total_booking_amount' => $totalBookingAmount,
                    'payment_mode' => $request->payment_mode,
                    'remark' => $request->remark,
                ]);



                if ($booking->leader_id && $booking->leader_commission_amount > 0) {

                    CommissionLedger::create([
                        'user_id' => $booking->leader_id,
                        'booking_id' => $booking->id,
                        'type' => 'commission',
                        'amount' => $leaderCommissionAmount,
                        'remark' => 'Leader commission from booking ' . $booking->id
                    ]);
                }

                if ($booking->adviser_id && $booking->adviser_commission_amount > 0) {

                    CommissionLedger::create([
                        'user_id' => $booking->adviser_id,
                        'booking_id' => $booking->id,
                        'type' => 'commission',
                        'amount' => $adviserCommissionAmount,
                        'remark' => 'Adviser commission from booking ' . $booking->id
                    ]);
                }

                if ($request->referral_id) {

                    $referral = Referral::find($request->referral_id);

                    if (!$referral) {
                        throw new \Exception("Referral not found.");
                    }

                    if ($referral->status == 'converted') {
                        throw new \Exception("This referral is already converted.");
                    }

                    if ($referral->assigned_to != $creator->id) {
                        throw new \Exception("You are not authorized to convert this referral.");
                    }

                    $incentive = ($totalBookingAmount * 5) / 100;

                    $referrer = User::find($referral->referrer_id);

                    if ($referrer) {

                        $referrer->increment('wallet_balance', $incentive);

                        WalletTransaction::create([
                            'user_id' => $referrer->id,
                            'amount' => $incentive,
                            'type' => 'credit',
                            'remark' => 'Referral Booking Incentive'
                        ]);
                    }

                    $referral->update([
                        'status' => 'converted',
                        'booking_id' => $booking->id,
                        'incentive_amount' => $incentive
                    ]);
                }

                return $booking;
            });


            return response()->json([
                'status' => true,
                'message' => 'Customer and Booking created successfully',
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

        $query = Booking::with('leader');

        // 🔐 Role Based Filter
        if ($user->role !== 'admin') {
            $query->where('user_code', $user->user_code);
        }
        $query = Booking::with(['leader', 'location']);
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


    public function mybookings()
    {
        $user = auth()->user();
        //  print_r($user);exit;
        $booking = Booking::where('email', $user->email)->get();
        // print_r($booking);exit;
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
            'dob',
            'pan_number',
            'aadhar_number',
            'address',
            'city',
            'state',
            'pincode',
            'advance_amount',

            'site_location',
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

            $totalAdvisors = User::where('role', 'adviser')
                ->where('created_by', $user->id)
                ->count();
            $totalBookingAmount = Booking::sum('total_booking_amount');
            $totalBooking = Booking::count();

            $totalsite = UserLocationCommission::count('id');


            $totalCommissionAmount = Booking::sum(
                DB::raw('leader_commission_amount + adviser_commission_amount')
            );

            $topAdvisor = Booking::select('user_code', DB::raw('SUM(advance_amount) as total'))
                ->groupBy('user_code')
                ->orderByDesc('total')
                ->first();

            // $totalCommissionAmount = CommissionLedger::where('type', 'commission')
            // ->sum('amount');

            $totalpaidamt = abs(
                CommissionLedger::where('type', 'payment')
                    ->sum('amount')
            );

            $totalbalanceamt = $totalCommissionAmount - $totalpaidamt;
        }

        // 🔹 If Leader → advisers created by this leader
        elseif ($user->role === 'leader') {

            // Get adviser user_codes created by leader
            $adviserCodes = User::where('created_by', $user->id)
                ->where('role', 'adviser')
                ->pluck('user_code');

            $totalAdvisors = $adviserCodes->count();

            $totalBookingAmount = Booking::whereIn('user_code', $adviserCodes)
                ->sum('total_booking_amount');

            $totalBooking = Booking::whereIn('user_code', $adviserCodes)
                ->count('total_booking_amount');

            $totalsite = UserLocationCommission::where('user_id', $user->id)
                ->count('id');

            $leaderCommission = Booking::where('leader_id', $user->id)
                ->sum('leader_commission_amount');

            $adviserCommission = Booking::where('leader_id', $user->id)
                ->sum('adviser_commission_amount');

            $totalCommissionAmount = $leaderCommission + $adviserCommission;

            $topAdvisor = Booking::whereIn('user_code', $adviserCodes)
                ->select('user_code', DB::raw('SUM(total_booking_amount) as total'))
                ->groupBy('user_code')
                ->orderByDesc('total')
                ->first();

            $teamIds = User::where('created_by', $user->id)
                ->pluck('id')
                ->push($user->id);

            // $totalCommissionAmount = CommissionLedger::whereIn('user_id', $teamIds)
            //     ->where('type', 'commission')
            //     ->sum('amount');

            $totalpaidamt = abs(
                CommissionLedger::whereIn('user_id', $teamIds)
                    ->where('type', 'payment')
                    ->sum('amount')
            );

            $totalbalanceamt = $totalCommissionAmount - $totalpaidamt;
        }

        // 🔹 If Adviser → only his own
        elseif ($user->role === 'adviser') {

            //  customer, booking amount, commission amount, site assinged, references
            $totalAdvisors = 1;

            $totalBookingAmount = Booking::where('user_code', $user->user_code)
                ->sum('total_booking_amount');

            $totalBooking = Booking::where('user_code', $user->user_code)
                ->count('total_booking_amount');

            $totalsite = UserLocationCommission::where('user_id', $user->id)
                ->count('id');

            $totalreferences = Referral::where('assigned_to', $user->id)
                ->count('id');

            $totalcustomer = User::where('created_by', $user->id)->count();

            $totalCommissionAmount = Booking::where('adviser_id', $user->id)
                ->sum('adviser_commission_amount');

            $topAdvisor = Booking::where('user_code', $user->user_code)
                ->select('user_code', DB::raw('SUM(advance_amount) as total'))
                ->groupBy('user_code')
                ->first();

            // $totalCommissionAmount = CommissionLedger::where('user_id', $user->id)
            //     ->where('type', 'commission')
            //     ->sum('amount');

            $totalpaidamt = abs(
                CommissionLedger::where('user_id', $user->id)
                    ->where('type', 'payment')
                    ->sum('amount')
            );

            $totalbalanceamt = $totalCommissionAmount - $totalpaidamt;
        } elseif ($user->role === 'customer') {

            // Customer bookings
            $totalBooking = Booking::where('created_by', $user->id)->count();

            // Total booking amount
            $totalBookingAmount = Booking::where('created_by', $user->id)
                ->sum('total_booking_amount');

            // Total advance paid
            $totalpaidamt = Booking::where('created_by', $user->id)
                ->sum('advance_amount');

            // Remaining balance
            $totalbalanceamt = $totalBookingAmount - $totalpaidamt;

            // Sites booked by customer
            $totalsite = Booking::where('created_by', $user->id)
                ->distinct('site_location')
                ->count('site_location');

            // References made by customer
            $totalreferences = Referral::where('referrer_id', $user->id)->count();

            // Customers created via referral (converted bookings)
            $totalcustomer = Referral::where('referrer_id', $user->id)
                ->where('status', 'converted')
                ->count();

            // Customer has no advisors
            $totalAdvisors = 0;

            // Customers don't earn commission
            $totalCommissionAmount = 0;

            // No top advisor for customer
            $topAdvisor = null;
        }

        $top_advisorname = User::where('user_code', $topAdvisor?->user_code)->first();

        return response()->json([
            'total_advisors' => $totalAdvisors, // done
            'total_booking_amount' => $totalBookingAmount, // done
            'total_booking' => $totalBooking ?? 0, // done
            'total_site' => $totalsite ?? 0, // done
            'total_customer' => $totalcustomer ?? 0,
            'total_references' => $totalreferences ?? 0, // for adviser reference of childs or for customer reference wgich are booked/completed
            'total_commission_amount' => $totalCommissionAmount,
            'total_balanceamt' => $totalbalanceamt ?? 0,
            'total_paidamt' => $totalpaidamt ?? 0,
            'top_advisor' => $topAdvisor?->user_code,
            'top_advisorname' => $top_advisorname?->name
        ]);
    }

    public function admdashboard()
    {
        $totalLeaders = User::where('role', 'leader')->count();

        $totalSites = LocationMaster::count();

        $totalBookings = Booking::count();

        $totalSalesValue = Booking::sum('commission_amount');

        $pendingCommissions = CommissionLedger::where('type', 'commission')
            ->sum('amount') - CommissionLedger::where('type', 'payment')->sum('amount');

        return response()->json([
            'status' => true,
            'data' => [
                'total_leaders' => $totalLeaders,
                'total_sites' => $totalSites,
                'total_bookings' => $totalBookings,
                'total_sales_value' => $totalSalesValue,
                'pending_commissions' => $pendingCommissions
            ]
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
            ->withSum('bookings as total_booking_amount', 'total_booking_amount')
            ->withSum('bookings as total_commission', 'adviser_commission_amount')
            ->orderByDesc('total_booking_amount')
            ->paginate($perPage);

        return response()->json([
            'status' => true,
            'data' => $advisers
        ]);
    }
}
