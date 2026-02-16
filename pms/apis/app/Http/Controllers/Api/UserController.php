<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createLeader(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $leader = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role'      => 'leader',
            'parent_id' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Leader created',
            'user'    => $leader
        ], 201);
    }

    /**
     * Check if authenticated user can create given role
     */
    private function canCreate(string $authRole, string $newRole): bool
    {
        return match ($authRole) {
            'admin'   => $newRole === 'leader',
            'leader'  => in_array($newRole, ['adviser', 'customer']),
            'adviser' => $newRole === 'customer',
            default   => false,
        };
    }

    /**
     * Create Leader / Adviser / Customer
     */
    public function store(Request $request)
{
    $auth = auth()->user();

    if (!$auth) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $rules = [
        'first_name' => 'required|string|max:100',
        'last_name'  => 'required|string|max:100',
        'email'      => 'required|email|unique:users,email',
        'password'   => 'required|min:6',
        'role'       => 'required|in:leader,adviser,customer',
    ];

    // Extra validation ONLY for leader
    if ($request->role === 'leader') {
        $rules += [
            'age'        => 'required|integer|min:18',
            'gender'     => 'required|in:male,female,other',
            'contact_no' => 'required|string|max:15',
            'city'       => 'required|string',
            'state'      => 'required|string',
            'address'    => 'required|string',
            'pin_code'   => 'required|string|max:10',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    $validated = $request->validate($rules);

    if (!$this->canCreate($auth->role, $validated['role'])) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    // Image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('leaders', 'public');
    }

    $user = User::create([
        'first_name'   => $validated['first_name'],
        'last_name'    => $validated['last_name'],
        'name'         => $validated['first_name'].' '.$validated['last_name'],
        'email'        => $validated['email'],
        'password'     => Hash::make($validated['password']),
        'role'         => $validated['role'],
        'age'          => $validated['age'] ?? null,
        'gender'       => $validated['gender'] ?? null,
        'contact_no'   => $validated['contact_no'] ?? null,
        'city'         => $validated['city'] ?? null,
        'state'        => $validated['state'] ?? null,
        'address'      => $validated['address'] ?? null,
        'pin_code'     => $validated['pin_code'] ?? null,
        'profile_image'=> $imagePath,
        'created_by'   => $auth->id,
    ]);

    return response()->json([
        'message' => ucfirst($validated['role']).' created successfully',
        'user' => $user
    ], 201);
}


    /**
     * Get direct downline (1-level)
     */
    public function myNetwork()
    {
        $auth = auth()->user();

        if (!$auth) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $network = User::where('created_by', $auth->id)
            ->select('id', 'name', 'email', 'role', 'created_by', 'created_at')
            ->paginate(10);

        return response()->json([
            'message' => 'My network fetched successfully',
            'data'    => $network
        ]);
    }
}
