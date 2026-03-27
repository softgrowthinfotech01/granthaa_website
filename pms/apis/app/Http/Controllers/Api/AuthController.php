<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
                : 'mobile_number';

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
}
