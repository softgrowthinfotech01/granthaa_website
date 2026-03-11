<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CommissionLedger;
use App\Models\CommissionPayment;
use App\Models\User;
use Illuminate\Http\Request;

class CommissionPaymentController extends Controller
{
   public function store(Request $request)
{
$request->validate([
'user_id'=>'required',
'amount'=>'required|numeric'
]);

$payment = CommissionLedger::create([
'user_id'=>$request->user_id,
'type'=>'payment',
'amount'=> -abs($request->amount),
'payment_mode'=>$request->payment_mode,
'reference_no'=>$request->reference_no,
'remark'=>$request->remark,
'created_by'=>auth()->id()
]);

return response()->json([
'status'=>true,
'message'=>'Payment recorded',
'data'=>$payment
]);

}
public function summary($userId)
{

$totalCommission = CommissionLedger::where('user_id',$userId)
->where('type','commission')
->sum('amount');

$totalPaid = CommissionLedger::where('user_id',$userId)
->where('type','payment')
->sum('amount');

$balance = $totalCommission + $totalPaid;

return response()->json([
'status'=>true,
'data'=>[
'total_commission'=>$totalCommission,
'total_paid'=>abs($totalPaid),
'balance'=>$balance
]
]);

}

public function ledger($userId)
{

$data = CommissionLedger::where('user_id',$userId)
->latest()
->paginate(50);

return response()->json([
'status'=>true,
'data'=>$data
]);

}

public function myCommission()
{

$user = auth()->user();

return response()->json([
'status'=>true,
'data'=>$user->commissionSummary()
]);

}

public function advisersCommission()
{

$leader = auth()->user();

if($leader->role != 'leader'){
return response()->json(['status'=>false,'message'=>'Unauthorized']);
}

$advisers = User::where('created_by',$leader->id)
->where('role','adviser')
->get();

$result = [];

foreach($advisers as $adv){

$summary = $adv->commissionSummary();

$result[] = [
'id'=>$adv->id,
'name'=>$adv->name,
'total_commission'=>$summary['total_commission'],
'total_paid'=>$summary['total_paid'],
'balance'=>$summary['balance']
];

}

return response()->json([
'status'=>true,
'data'=>$result
]);

}

public function teamCommission()
{

$leader = auth()->user();

$users = User::where('id',$leader->id)
->orWhere('created_by',$leader->id)
->get();

$data=[];

foreach($users as $user){

$summary=$user->commissionSummary();

$data[]=[
'id'=>$user->id,
'name'=>$user->name,
'role'=>$user->role,
'total_commission'=>$summary['total_commission'],
'total_paid'=>$summary['total_paid'],
'balance'=>$summary['balance']
];

}

return response()->json([
'status'=>true,
'data'=>$data
]);

}
}
