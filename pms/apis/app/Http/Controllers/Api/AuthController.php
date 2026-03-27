<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register new user
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'contact_no' => 'required|digit:10',
            'aadhaar_number'  => 'required|digit:12',
            'password'  => 'required|min:6',
            'role'      => 'nullable|in:admin,leader,adviser,customer',
            'parent_id' => 'nullable|exists:users,id'
        ]);

        $user = User::create([
            'user_code' => 'ADM001',
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'contact_no'     => $validated['contact_no'],
            'aadhaar_number'     => $validated['aadhaar_number'],
            'password'  => Hash::make($validated['password']),
            'role'      => $validated['role'] ?? 'admin',
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user
        ], 201);
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required', // email OR mobile
            'password' => 'required'
        ]);

        // detect email or mobile
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'contact_no';

        $user = User::where($field, $request->login)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['Invalid credentials'],
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => $user
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate token
        $token = Str::random(60);

        // Delete old tokens
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Insert new token
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now()
        ]);

        // 👉 Later send email / SMS here

        return response()->json([
            'status' => true,
            'message' => 'Password reset token generated',
            'token' => $token // for testing (remove in production)
        ]);
    }

    public function verifyResetToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required'
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token'
            ]);
        }

        if (!Hash::check($request->token, $record->token)) {
            return response()->json([
                'status' => false,
                'message' => 'Token mismatch'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Token verified'
        ]);
    }

    public function resetPassword(Request $request)
    {
        // print_r("hello");exit;
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6'
        ]);
        // print_r($request->email);exit;
        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid request'
            ]);
        }

        if (!Hash::check($request->token, $record->token)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token'
            ]);
        }

        // Update password
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete token after reset
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Password reset successfully'
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        $user = $request->user();
// print_r($user->email);exit;
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password incorrect'
            ], 400);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Password changed successfully'
        ]);
    }
}
