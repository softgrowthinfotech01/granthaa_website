<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingPayment;
use App\Models\CommissionLedger;
use App\Models\LocationMaster;
use App\Models\Referral;
use App\Models\User;
use App\Models\UserLocationCommission;
use App\Models\WalletTransaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

        try {

            $booking = DB::transaction(function () use ($request, $leader) {

                $commissionValue = (float) str_replace(['₹', ',', ' '], '', $request->commission_value);
                $totalBookingAmount = (float) str_replace(['₹', ',', ' '], '', $request->total_booking_amount);

                $commissionAmount = 0;

                if ($request->commission_type === "percent") {
                    $commissionAmount = ($totalBookingAmount * $commissionValue) / 100;
                } elseif ($request->commission_type === "amount") {
                    $commissionAmount = $commissionValue;
                }

                $commission_amount = round($commissionAmount, 2);

                $newUser = User::where('email', $request->email)
                    ->orWhere('contact_no', $request->mobile)
                    ->first();

                if ($newUser) {

                    // ❌ email same but mobile different
                    if (
                        $newUser->email == $request->email &&
                        $newUser->contact_no != $request->mobile
                    ) {

                        throw new \Exception(
                            "Email already exists with different mobile number."
                        );
                    }

                    // ❌ mobile same but email different
                    if (
                        $newUser->contact_no == $request->mobile &&
                        $newUser->email != $request->email
                    ) {

                        throw new \Exception(
                            "Mobile already exists with different email."
                        );
                    }

                    // ✅ SAME USER FOUND → reuse
                } else {

                    // ✅ CREATE NEW USER
                    $userCode = $this->generateUserCode('customer');

                    $newUser = User::create([
                        'user_code' => $userCode,
                        'name' => $request->buyer_name,
                        'email' => $request->email,
                        'aadhaar_number' => $request->aadhar_number,
                        'password' => $request->mobile,
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

                $referral = null;

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
                }

                // 🚫 Prevent duplicate booking for same plot & location
                $existingBooking = Booking::whereNull('deleted_at')->where('plot_number', $request->plot_number)
                    ->where('site_location', $request->site_location)
                    ->lockForUpdate() // prevents race condition
                    ->first();

                if ($existingBooking) {
                    throw new \Exception(
                        "This plot number is already booked for the selected site location."
                    );
                }

                // 2️⃣ Create Booking
                $booking = Booking::create([
                    'user_id' => $newUser->id,
                    'user_code' => $newUser->user_code,

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
                    'referral_id' => $request->referral_id,
                ]);

                // AFTER Booking::create()

                if ($request->referral_id) {

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
                        'booking_id' => $booking->id, // ✅ now booking exists
                        'incentive_amount' => $incentive
                    ]);
                }

                // ✅ Store advance payment in booking_payments table
                $advanceAmount = (float) str_replace(['₹', ',', ' '], '', $request->advance_amount);
                if ($advanceAmount > 0) {
                    BookingPayment::create([
                        'booking_id' => $booking->id,
                        'user_id' => $newUser->id,
                        'received_by' => $creator->id,
                        'amount' => $advanceAmount,
                        'payment_type' => 'advance',
                        'payment_mode' => $request->payment_mode,
                        'remark' => 'Advance payment at booking time'
                    ]);
                }

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

        // ✅ Only define once
        $query = Booking::whereNull('deleted_at')->with(['leader', 'location', 'payments' => function ($q) {
            $q->where('payment_type', '!=', 'reversal');
        }]);

        // 🔐 Role Based Filter
        if ($user->role === 'leader') {
            $query->where('leader_id', $user->id);
        } elseif ($user->role === 'adviser') {
            $query->where('adviser_id', $user->id);
        } elseif ($user->role === 'customer') {
            $query->where('user_id', $user->id);
        }
        // ✅ Admin sees all → no filter

        // 🔎 Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('buyer_name', 'like', "%$search%")
                    ->orWhere('mobile', 'like', "%$search%")
                    ->orWhere('project_name', 'like', "%$search%")
                    ->orWhere('plot_number', 'like', "%$search%");
            });
        }

        // 📅 Date filter
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [
                $request->from_date,
                $request->to_date
            ]);
        }

        // 📄 Pagination
        $perPage = $request->per_page ?? 10;

        $bookings = $query->latest()->paginate($perPage);

        return response()->json([
            'status' => true,
            'data' => $bookings
        ]);
    }


    public function show($id)
    {
        $booking = Booking::whereNull('deleted_at')->with('leader')->findOrFail($id);

        return response()->json($booking);
    }


    public function mybookings()
    {
        $user = auth()->user();
        //  print_r($user);exit;
        $booking = Booking::whereNull('deleted_at')->where('user_id', $user->id)->get();
        // print_r($booking);exit;
        return response()->json($booking);
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::whereNull('deleted_at')
            ->with('booking')
            ->findOrFail($id);

        $user = auth()->user();

        // Authorization
        if ($user->role !== 'admin' && $booking->created_by != $user->id) {
            abort(403, 'Unauthorized');
        }

        try {

            DB::transaction(function () use ($request, $booking) {

                /*
            |--------------------------------------------------------------------------
            | Financial Lock Check
            |--------------------------------------------------------------------------
            */
                $hasPayment = BookingPayment::where('booking_id', $booking->id)->where('amount', '>', 0)->exists();
                $hasCommission = CommissionLedger::where('booking_id', $booking->id)->where('type', 'payment')->exists();

                $canEditPlot = !$hasPayment && !$hasCommission;

                /*
            |--------------------------------------------------------------------------
            | Block Plot Change After Transaction
            |--------------------------------------------------------------------------
            */
                if (!$canEditPlot) {

                    $tempBooking = clone $booking;

                    // apply only incoming values
                    $tempBooking->fill($request->only([
                        'plot_number',
                        'site_location'
                    ]));

                    if ($tempBooking->isDirty(['plot_number', 'site_location'])) {
                        throw new \Exception(
                            'Booking is having transactions. Plot cannot be changed.'
                        );
                    }
                }


                $totalAmountChanged =
                    $request->filled('total_booking_amount') &&
                    $request->total_booking_amount != $booking->total_booking_amount;

                if (!$canEditPlot && $totalAmountChanged) {
                    throw new \Exception(
                        'Transactions exist. Total booking amount cannot be changed.'
                    );
                }

                /*
            |--------------------------------------------------------------------------
            | Duplicate Plot Check
            |--------------------------------------------------------------------------
            */
                if (
                    $canEditPlot &&
                    $request->filled('plot_number') &&
                    $request->filled('site_location')
                ) {

                    $exists = Booking::where('site_location', $request->site_location)
                        ->where('plot_number', $request->plot_number)
                        ->whereNull('deleted_at')
                        ->where('id', '<>', $booking->id)
                        ->exists();

                    if ($exists) {
                        throw new \Exception('Plot already booked.');
                    }
                }

                /*
            |--------------------------------------------------------------------------
            | Update Customer
            |--------------------------------------------------------------------------
            */
                if ($booking->user) {
                    $booking->user->update(array_filter([
                        'name' => $request->buyer_name,
                        // 'contact_no' => $request->mobile,
                        'address' => $request->address,
                        'city' => $request->city,
                        'state' => $request->state,
                    ]));
                }

                /*
            |--------------------------------------------------------------------------
            | Update Booking
            |--------------------------------------------------------------------------
            */
                $updateData = $request->only([
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
                ]);

                if ($canEditPlot) {
                    $updateData['plot_number'] = $request->plot_number;
                    $updateData['site_location'] = $request->site_location;
                    $updateData['total_booking_amount'] = $request->total_booking_amount;
                }

                if ($canEditPlot && $totalAmountChanged) {

                    $newAmount = (float) $request->total_booking_amount;

                    /*
    |--------------------------------------------------------------------------
    | Leader Commission Recalculate
    |--------------------------------------------------------------------------
    */
                    if ($booking->leader_commission_type === 'percent') {
                        $leaderCommission =
                            ($newAmount * $booking->leader_commission_value) / 100;
                    } else {
                        $leaderCommission = $booking->leader_commission_value;
                    }

                    /*
    |--------------------------------------------------------------------------
    | Adviser Commission Recalculate
    |--------------------------------------------------------------------------
    */
                    if ($booking->adviser_commission_type === 'percent') {
                        $adviserCommission =
                            ($newAmount * $booking->adviser_commission_value) / 100;
                    } else {
                        $adviserCommission = $booking->adviser_commission_value;
                    }

                    /*
    |--------------------------------------------------------------------------
    | Update Booking Commission Columns
    |--------------------------------------------------------------------------
    */
                    $booking->update([
                        'leader_commission_amount' => $leaderCommission,
                        'adviser_commission_amount' => $adviserCommission,
                        'commission_amount' => abs($leaderCommission) + abs($adviserCommission)
                    ]);

                    /*
    |--------------------------------------------------------------------------
    | Update Commission Ledger (ONLY commission type)
    |--------------------------------------------------------------------------
    */
                    CommissionLedger::where('booking_id', $booking->id)
                        ->where('type', 'commission')
                        ->where('user_id', $booking->leader_id)
                        ->update(['amount' => $leaderCommission]);

                    CommissionLedger::where('booking_id', $booking->id)
                        ->where('type', 'commission')
                        ->where('user_id', $booking->adviser_id)
                        ->update(['amount' => $adviserCommission]);
                }

                $booking->update(array_filter($updateData));

                /*
            |--------------------------------------------------------------------------
            | Advance Payment Sync
            |--------------------------------------------------------------------------
            */
                if ($request->advance_amount) {

                    BookingPayment::updateOrCreate(
                        [
                            'booking_id' => $booking->id,
                            'payment_type' => 'advance'
                        ],
                        [
                            'user_id' => $booking->user_id,
                            'received_by' => auth()->id(),
                            'amount' => $request->advance_amount,
                            'payment_mode' => $request->payment_mode
                        ]
                    );

                    $booking->update([
                        'advance_amount' => $request->advance_amount
                    ]);
                }
            });

            return response()->json([
                'status' => true,
                'message' => 'Booking updated successfully'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->errorInfo[1] == 1062) {
                return response()->json([
                    'status' => false,
                    'message' => 'Plot already booked for this site.'
                ], 422);
            }

            throw $e;
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $booking = Booking::findOrFail($id);
            $user = auth()->user();

            if (
                $user->role != 'admin' &&
                $booking->created_by != $user->id
            ) {
                abort(403, 'Unauthorized');
            }

            if ($booking->deleted_at) {
                throw new Exception('Booking already deleted.');
            }

            $payments = BookingPayment::where('booking_id', $booking->id)->get();

            foreach ($payments as $payment) {
                BookingPayment::create([
                    'booking_id' => $booking->id,
                    'user_id' => $payment->user_id,
                    'received_by' => auth()->id(),
                    'amount' => -$payment->amount,
                    'payment_type' => 'reversal',
                    'payment_mode' => $payment->payment_mode,
                    'remark' => 'Booking delete payment reversal'
                ]);
            }

            $ledgers = CommissionLedger::where('booking_id', $booking->id)
                ->where('type', 'commission')
                ->get();

            foreach ($ledgers as $ledger) {
                CommissionLedger::create([
                    'user_id' => $ledger->user_id,
                    'booking_id' => $booking->id,
                    'type' => 'reversal',
                    'amount' => -$ledger->amount,
                    'remark' => 'Commission reversed due to booking delete'
                ]);
            }

            $referral = Referral::where('booking_id', $booking->id)->first();

            if ($referral && $referral->incentive_amount > 0) {

                $referrer = User::findOrFail($referral->referrer_id);

                if ($referrer->wallet_balance < $referral->incentive_amount) {
                    throw new Exception('Wallet already used.');
                }

                $referrer->decrement(
                    'wallet_balance',
                    $referral->incentive_amount
                );

                WalletTransaction::create([
                    'user_id' => $referrer->id,
                    'amount' => $referral->incentive_amount,
                    'type' => 'debit',
                    'remark' => 'Referral reversed due to booking delete'
                ]);

                // keep incentive amount for restore
                $referral->update([
                    'status' => 'deleted'
                ]);
            }

            $booking->delete();
        });

        return response()->json([
            'status' => true,
            'message' => 'Booking moved to trash'
        ]);
    }

    public function restore($id)
    {
        DB::transaction(function () use ($id) {

            $booking = Booking::withTrashed()->findOrFail($id);

            if (!$booking->trashed()) {
                throw new Exception('Booking not deleted.');
            }

            /*
        |--------------------------------------------------------------------------
        | Restore Booking
        |--------------------------------------------------------------------------
        */
            $booking->restore();

            /*
        |--------------------------------------------------------------------------
        | Remove Reversal Entries
        |--------------------------------------------------------------------------
        */
            BookingPayment::where('booking_id', $booking->id)
                ->where('payment_type', 'reversal')
                ->delete();

            CommissionLedger::where('booking_id', $booking->id)
                ->where('type', 'reversal')
                ->delete();

            /*
        |--------------------------------------------------------------------------
        | Restore Referral Wallet
        |--------------------------------------------------------------------------
        */
            $referral = Referral::where('booking_id', $booking->id)->first();

            if ($referral && $referral->status === 'deleted') {

                $referrer = User::find($referral->referrer_id);

                if ($referrer) {
                    $referrer->increment(
                        'wallet_balance',
                        $referral->incentive_amount
                    );

                    WalletTransaction::create([
                        'user_id' => $referrer->id,
                        'amount' => $referral->incentive_amount,
                        'type' => 'credit',
                        'remark' => 'Referral restored after booking restore'
                    ]);
                }

                $referral->update([
                    'status' => 'converted'
                ]);
            }
        });

        return response()->json([
            'status' => true,
            'message' => 'Booking restored successfully'
        ]);
    }

    public function forceDelete($id)
    {
        DB::transaction(function () use ($id) {

            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized');
            }

            $booking = Booking::withTrashed()->findOrFail($id);

            if (!$booking->trashed()) {
                throw new Exception('Only trashed bookings can be permanently deleted.');
            }

            /*
        |--------------------------------------------------------------------------
        | Delete Financial Records
        |--------------------------------------------------------------------------
        */
            BookingPayment::where('booking_id', $booking->id)->delete();

            CommissionLedger::where('booking_id', $booking->id)->delete();

            Referral::where('booking_id', $booking->id)
                ->update([
                    'booking_id' => null,
                    'status' => 'pending'
                ]);

            /*
        |--------------------------------------------------------------------------
        | Permanent Delete
        |--------------------------------------------------------------------------
        */
            $booking->forceDelete();
        });

        return response()->json([
            'status' => true,
            'message' => 'Booking permanently deleted'
        ]);
    }

    public function trash()
    {
        return response()->json([
            'status' => true,
            'data' => Booking::onlyTrashed()->latest()->get()
        ]);
    }

    public function dashboard()
    {
        $user = auth()->user();

        try {

            // Common response structure
            $response = [
                'status' => true,
                'role' => $user->role,
                'data' => []
            ];

            // ===============================
            // 🟣 ADMIN DASHBOARD
            // ===============================
            if ($user->role === 'admin') {

                $totalAdvisors = User::where('role', 'adviser')
                    ->where('created_by', $user->id)
                    ->count();

                $totalBookingAmount = Booking::whereNull('deleted_at')->sum('total_booking_amount');
                $totalBooking = Booking::whereNull('deleted_at')->count();
                $totalSite = UserLocationCommission::count();

                $totalCommissionAmount = Booking::whereNull('deleted_at')->sum(
                    DB::raw('leader_commission_amount + adviser_commission_amount')
                );

                $totalPaidAmt = abs(
                    CommissionLedger::where('type', 'payment')
                        ->where('amount', '>', 0)->sum('amount')
                );

                $topAdvisor = BookingPayment::where('payment_type', '!=', 'reversal')
                    ->where('amount', '>', 0)
                    ->select('user_id', DB::raw('SUM(amount) as total'))
                    ->groupBy('user_id')
                    ->orderByDesc('total')
                    ->first();

                $response['data'] = [
                    'total_advisors' => $totalAdvisors,
                    'total_booking_amount' => $totalBookingAmount,
                    'total_booking' => $totalBooking,
                    'total_site' => $totalSite,
                    'total_commission_amount' => $totalCommissionAmount,
                    'total_paidamt' => $totalPaidAmt,
                    'total_balanceamt' => $totalCommissionAmount - $totalPaidAmt,
                    'top_advisor' => $topAdvisor
                ];
            }

            // ===============================
            // 🔵 LEADER DASHBOARD
            // ===============================
            elseif ($user->role === 'leader') {

                $teamIds = User::where('created_by', $user->id)
                    ->pluck('id')
                    ->push($user->id);

                $my_total_booking = Booking::whereNull('deleted_at')->where('leader_id', $user->id)
                    ->whereNull('adviser_id')
                    ->count();

                $my_total_booking_amount = Booking::whereNull('deleted_at')->where('leader_id', $user->id)
                    ->whereNull('adviser_id')
                    ->sum('total_booking_amount');

                $team_total_booking = Booking::whereNull('deleted_at')->where('leader_id', $user->id)
                    ->whereNotNull('adviser_id')
                    ->count();

                $team_total_booking_amount = Booking::whereNull('deleted_at')->where('leader_id', $user->id)
                    ->whereNotNull('adviser_id')
                    ->sum('total_booking_amount');

                $totalAdvisors = User::where('created_by', $user->id)
                    ->where('role', 'adviser')
                    ->count();

                $totalSite = UserLocationCommission::where('user_id', $user->id)->count();

                $my_commission = Booking::whereNull('deleted_at')->where('leader_id', $user->id)
                    ->whereNull('adviser_id') // only leader deals
                    ->sum('leader_commission_amount');

                $team_commission = Booking::whereNull('deleted_at')->where('leader_id', $user->id)
                    ->whereNotNull('adviser_id') // adviser deals
                    ->sum('leader_commission_amount');

                $team_adviser_commission = Booking::whereNull('deleted_at')->where('leader_id', $user->id)
                    ->whereNotNull('adviser_id')
                    ->sum('adviser_commission_amount');

                $totalCommissionAmount = Booking::whereNull('deleted_at')->where('leader_id', $user->id)
                    ->sum(DB::raw('leader_commission_amount + adviser_commission_amount'));

                $totalPaidAmt = abs(
                    CommissionLedger::whereIn('user_id', $teamIds)
                        ->where('type', 'payment')
                        ->where('amount', '>', 0)
                        ->sum('amount')
                );

                $topAdvisor = Booking::whereNull('deleted_at')->where('leader_id', $user->id)
                    ->whereNotNull('adviser_id') // only adviser bookings
                    ->select('adviser_id', DB::raw('SUM(total_booking_amount) as total'))
                    ->groupBy('adviser_id')
                    ->orderByDesc('total')
                    ->first();

                $response['data'] = [
                    'total_advisors' => $totalAdvisors,
                    'my_total_booking' => $my_total_booking,
                    'my_total_booking_amount' => $my_total_booking_amount,
                    'team_total_booking' => $team_total_booking,
                    'team_total_booking_amount' => $team_total_booking_amount,
                    'total_booking' => $my_total_booking + $team_total_booking,
                    'total_booking_amount' => $my_total_booking_amount + $team_total_booking_amount,
                    'total_site' => $totalSite,
                    'total_commission_amount' => $totalCommissionAmount,
                    'total_paidamt' => $totalPaidAmt,
                    'total_balanceamt' => $totalCommissionAmount - $totalPaidAmt,
                    'top_advisor' => $topAdvisor,

                    'my_commission' => $my_commission +  $team_commission,
                    'team_commission' => $team_adviser_commission,

                    'total_commission_amount' => $my_commission + $team_commission + $team_adviser_commission,
                ];
            }

            // ===============================
            // 🟡 ADVISER DASHBOARD
            // ===============================
            elseif ($user->role === 'adviser') {

                $totalBookingAmount = Booking::whereNull('deleted_at')->where('adviser_id', $user->id)
                    ->sum('total_booking_amount');

                $totalBooking = Booking::whereNull('deleted_at')->where('adviser_id', $user->id)->count();

                $totalSite = UserLocationCommission::where('user_id', $user->id)->count();

                $totalReferences = Referral::where('assigned_to', $user->id)->count();

                $totalCustomers = User::where('created_by', $user->id)->count();

                $totalCommissionAmount = Booking::whereNull('deleted_at')->where('adviser_id', $user->id)
                    ->sum('adviser_commission_amount');

                $totalPaidAmt = abs(
                    CommissionLedger::where('user_id', $user->id)
                        ->where('type', 'payment')
                        ->where('amount', '>', 0)
                        ->sum('amount')
                );

                $topAdvisor = Booking::whereNull('deleted_at')->where('adviser_id', $user->id)
                    ->select('user_code', DB::raw('SUM(total_booking_amount) as total'))
                    ->groupBy('user_code')
                    ->first();

                $response['data'] = [
                    'total_advisors' => 1,
                    'total_booking_amount' => $totalBookingAmount,
                    'total_booking' => $totalBooking,
                    'total_site' => $totalSite,
                    'total_customer' => $totalCustomers,
                    'total_references' => $totalReferences,
                    'total_commission_amount' => $totalCommissionAmount,
                    'total_paidamt' => $totalPaidAmt,
                    'total_balanceamt' => $totalCommissionAmount - $totalPaidAmt,
                    'top_advisor' => $topAdvisor
                ];
            }

            // ===============================
            // 🟢 CUSTOMER DASHBOARD
            // ===============================
            elseif ($user->role === 'customer') {

                $totalBooking = Booking::whereNull('deleted_at')->where('user_code', $user->user_code)->count();

                $totalBookingAmount = Booking::whereNull('deleted_at')->where('user_code', $user->user_code)
                    ->sum('total_booking_amount');

                $totalPaidAmt = BookingPayment::where('user_id', $user->id)
                    ->sum('amount');

                $totalSite = Booking::whereNull('deleted_at')->where('user_code', $user->user_code)
                    ->distinct('site_location')
                    ->count('site_location');

                $totalReferences = Referral::where('referrer_id', $user->id)->count();

                $totalCustomers = Referral::where('referrer_id', $user->id)
                    ->where('status', 'converted')
                    ->count();

                $response['data'] = [
                    'total_advisors' => 0,
                    'total_booking_amount' => $totalBookingAmount,
                    'total_booking' => $totalBooking,
                    'total_site' => $totalSite,
                    'total_customer' => $totalCustomers,
                    'total_references' => $totalReferences,
                    'total_commission_amount' => 0,
                    'total_paidamt' => $totalPaidAmt,
                    'total_balanceamt' => $totalBookingAmount - $totalPaidAmt,
                    'top_advisor' => null
                ];
            }

            // ===============================
            // 👤 ADD TOP ADVISOR NAME
            // ===============================
            if (!empty($response['data']['top_advisor'])) {

                $advisor = User::find($response['data']['top_advisor']->adviser_id);

                $response['data']['top_advisor_name'] = $advisor?->name;
                $response['data']['user_code'] = $advisor?->user_code;
            } else {
                $response['data']['top_advisor_name'] = null;
            }

            return response()->json($response);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function admdashboard()
    {
        $totalLeaders = User::where('role', 'leader')->count();

        $totalAdvisers = User::where('role', 'adviser')->count(); // ✅ NEW

        $totalCustomers = User::where('role', 'customer')->count(); // ✅ NEW

        $totalSites = LocationMaster::count();

        $totalBookings = Booking::whereNull('deleted_at')->count();

        $totalSalesValue = Booking::whereNull('deleted_at')->sum('total_booking_amount'); // ✅ FIXED (better than commission)

        // ✅ Commission totals
        $totalCommission = CommissionLedger::where('type', 'commission')->where('amount', '>', 0)->sum('amount');

        $totalPaid = abs(
            CommissionLedger::where('type', 'payment')->where('amount', '>', 0)->sum('amount')
        );

        $pendingCommissions = $totalCommission - $totalPaid;

        // ✅ Today stats
        $todayBookings = Booking::whereNull('deleted_at')->whereDate('created_at', today())->count();

        $todaySales = Booking::whereNull('deleted_at')->whereDate('created_at', today())
            ->sum('total_booking_amount');

        // ✅ Top Leader (by sales)
        $topLeader = Booking::whereNull('deleted_at')->select('leader_id', DB::raw('SUM(total_booking_amount) as total'))
            ->groupBy('leader_id')
            ->orderByDesc('total')
            ->first();

        $topLeaderName = null;

        if ($topLeader) {
            $leader = User::find($topLeader->leader_id);
            $topLeaderName = $leader?->name;
        }

        return response()->json([
            'status' => true,
            'data' => [
                'total_leaders' => $totalLeaders,
                'total_advisers' => $totalAdvisers, // ✅ NEW
                'total_customers' => $totalCustomers, // ✅ NEW

                'total_sites' => $totalSites,

                'total_bookings' => $totalBookings,
                'today_bookings' => $todayBookings, // ✅ NEW

                'total_sales_value' => $totalSalesValue,
                'today_sales' => $todaySales, // ✅ NEW

                'total_commission' => $totalCommission, // ✅ NEW
                'total_paid' => $totalPaid, // ✅ NEW
                'pending_commissions' => $pendingCommissions,

                'top_leader_name' => $topLeaderName // ✅ NEW
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


    public function customers()
    {
        $user = auth()->user();

        $query = Booking::whereNull('deleted_at');

        // Role filter
        if ($user->role === 'leader') {
            $query->where('leader_id', $user->id);
        } elseif ($user->role === 'adviser') {
            $query->where('adviser_id', $user->id);
        }

        $customers = $query
            ->select('user_id', 'user_code', 'buyer_name')
            ->distinct('user_id')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $customers
        ]);
    }

    public function projectsByCustomer($userId)
    {
        $projects = Booking::whereNull('deleted_at')->where('user_id', $userId)
            ->select('project_name')
            ->distinct()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $projects
        ]);
    }

    public function plots($userId, $project)
    {
        $plots = Booking::whereNull('deleted_at')->where('user_id', $userId)
            ->where('project_name', $project)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $plots
        ]);
    }

    public function leaderSummary()
    {
        $leaders = User::where('role', 'leader')->get();

        $data = [];

        foreach ($leaders as $leader) {

            // Leader bookings (self + advisers)
            $bookings = Booking::whereNull('deleted_at')->where(function ($q) use ($leader) {
                $q->where('leader_id', $leader->id)
                    ->orWhere('created_by', $leader->id);
            })->get();

            $totalPlots = $bookings->count();

            $totalBookingAmount = $bookings->sum(function ($b) {
                return (float) $b->total_booking_amount;
            });

            $totalCommission = $bookings->sum(function ($b) {
                return (float) $b->commission_amount;
            });

            // Paid amount from ledger
            $paidAmount = abs(
                CommissionLedger::where('user_id', $leader->id)
                    ->where('type', 'payment')
                    ->where('amount', '>', 0)
                    ->sum('amount')
            );

            $balance = $totalCommission - $paidAmount;

            $data[] = [
                'leader_id' => $leader->id,
                'leader_name' => $leader->name,
                'total_plots' => $totalPlots,
                'total_booking_amount' => $totalBookingAmount,
                'total_commission' => $totalCommission,
                'paid_amount' => $paidAmount,
                'balance_amount' => $balance
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function leaderDetails($leaderId)
    {
        $bookings = Booking::whereNull('deleted_at')->where(function ($q) use ($leaderId) {
            $q->where('leader_id', $leaderId)
                ->orWhere('created_by', $leaderId);
        })->get();

        $data = [];
        // print_r($bookings);exit;

        foreach ($bookings as $b) {

            $role = $b->adviser_id ? 'Adviser' : 'Leader';
            $userId = $b->leader_id;

            $paid = abs(
                CommissionLedger::where('user_id', $userId)
                    ->where('booking_id', $b->id)
                    ->where('type', 'payment') // ✅ IMPORTANT FIX
                    ->where('amount', '<', 0)
                    ->sum('amount')
            );

            $booking_amount =  (float) $b->total_booking_amount;

            $commission = $role === 'Leader'
                ? (float) $b->leader_commission_amount + (float) $b->adviser_commission_amount
                : (float) $b->adviser_commission_amount;

            $totalcommission = (float) $b->commission_amount;

            $balance = $commission - $paid;
            $totalbalance = $totalcommission - $paid;

            $data[] = [
                'booking_id' => $b->id,
                'buyer_name' => $b->buyer_name,
                'role' => $role,
                'plot_number' => $b->plot_number,
                'booking_amount' => $booking_amount,
                'commission' => $commission,
                'total_commission' => $totalcommission,
                'paid' => $paid,
                'balance' => $balance,
                'total_balance' => $totalbalance
            ];
        }
        // print_r($data);exit;

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function adviserDetails($adviserId)
    {
        $bookings = Booking::whereNull('deleted_at')->where('adviser_id', $adviserId)->get();

        $data = [];

        foreach ($bookings as $b) {

            $paid = abs(
                CommissionLedger::where('user_id', $adviserId)
                    ->where('booking_id', $b->id)
                    ->where('type', 'payment')
                    ->where('amount', '>', 0)
                    ->sum('amount')
            );

            $commission = (float) $b->adviser_commission_amount;

            $balance = $commission - $paid;

            $data[] = [
                'booking_id' => $b->id,
                'buyer_name' => $b->buyer_name,
                'plot_number' => $b->plot_number,
                'commission' => $commission,
                'paid' => $paid,
                'balance' => $balance
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function recentPayments()
    {
        $payments = CommissionLedger::where('type', 'payment')
            ->with('user') // relation needed
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $payments
        ]);
    }

    public function salesTrend()
    {
        $data = Booking::whereNull('deleted_at')->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_booking_amount) as total')
        )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function commissionSplit()
    {
        $leader = auth()->user();

        // print_r($leader);exit;
        $leaderCommission = CommissionLedger::where('user_id', $leader->id)
            ->where('type', 'commission')
            ->where('amount', '>', 0)
            ->sum('amount');

        $adviserIds = User::where('created_by', $leader->id)
            ->where('role', 'adviser')
            ->pluck('id');

        $adviserCommission = CommissionLedger::whereIn('user_id', $adviserIds)
            ->where('type', 'commission')
            ->where('amount', '>', 0)
            ->sum('amount');

        $total = $leaderCommission + $adviserCommission;

        return response()->json([
            'status' => true,
            'data' => [
                'leader_commission' => $leaderCommission,
                'adviser_commission' => $adviserCommission,
                'total_network_commission' => $total
            ]
        ]);
    }


    public function dashboardAlerts()
    {
        $alerts = [];

        // 🔴 High Pending Commission Leaders
        $leaders = User::where('role', 'leader')->get();

        foreach ($leaders as $leader) {

            $totalCommission = Booking::whereNull('deleted_at')->where('leader_id', $leader->id)
                ->sum(DB::raw('leader_commission_amount + adviser_commission_amount'));

            $paid = abs(
                CommissionLedger::where('user_id', $leader->id)
                    ->where('type', 'payment')
                    ->where('amount', '>', 0)
                    ->sum('amount')
            );

            $balance = $totalCommission - $paid;

            if ($balance > 50000) {
                $alerts[] = "⚠️ {$leader->name} has pending commission ₹{$balance}";
            }
        }

        // 🟡 Advisers with ZERO bookings
        $advisers = User::where('role', 'adviser')->get();

        foreach ($advisers as $adv) {

            $count = Booking::whereNull('deleted_at')->where('adviser_id', $adv->id)->count();

            if ($count == 0) {
                $alerts[] = "⚠️ Adviser {$adv->name} has no bookings";
            }
        }

        // 🔵 No payments today
        $todayPayments = CommissionLedger::where('type', 'payment')->where('amount', '>', 0)
            ->whereDate('created_at', today())
            ->count();

        if ($todayPayments == 0) {
            $alerts[] = "⚠️ No payments recorded today";
        }

        return response()->json([
            'status' => true,
            'data' => $alerts
        ]);
    }
}
