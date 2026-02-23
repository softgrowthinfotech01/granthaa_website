<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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


    /**
     * Show Single User
     */
    public function show($id)
    {
        $auth = auth()->user();

        if (!$auth) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Admin can view anyone
        if ($auth->role !== 'admin' && $user->created_by !== $auth->id && $auth->id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'message' => 'User fetched successfully',
            'data' => $user
        ]);
    }


    public function index(Request $request)
    {
        $query = User::query();

        $auth = auth()->user();

        if (!$auth) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // Search filter
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Per page value (default 5)
        $perPage = $request->per_page ?? 5;

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        return response()->json([
            'message' => 'Users fetched successfully',
            'total'   => $users->count(),
            'data' => $users
        ]);
    }

    private function canCreate(string $authRole, string $newRole): bool
    {
        return match ($authRole) {
            'admin'   => $newRole === 'leader',
            'leader'  => in_array($newRole, ['adviser', 'customer']),
            'adviser' => $newRole === 'customer',
            default   => false,
        };
    }

    public function store(Request $request)
    {
        $auth = auth()->user();
        // print_r($auth);exit;
        if (!$auth) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $rules = [
            'name' => 'required|string|max:200',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6',
            'role'       => 'required|in:leader,adviser,customer',
        ];

        // Extra validation ONLY for leader
        if ($request->role === 'leader') {
            $rules += [
                'age'        => 'required|integer|min:18',
                'gender'     => 'required|in:male,female,others',
                'contact_no' => 'required|string|max:15',
                'city'       => 'required|string',
                'state'      => 'required|string',
                'address'    => 'required|string',
                'pin_code'   => 'required|string|max:10',
                'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'bank_name'  => 'required|string',
                'bank_branch'  => 'required|string',
                'bank_account_no'  => 'required|string',
                'bank_ifsc_code'  => 'required|string',
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

        $userCode = $this->generateUserCode($validated['role']);

        $user = User::create([
            'user_code' => $userCode,
            'name'    => $validated['name'],
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
            'profile_image' => $imagePath,
            'bank_name'  => $validated['bank_name'] ?? null,
            'bank_branch'  => $validated['bank_branch'] ?? null,
            'bank_account_no'  => $validated['bank_account_no'] ?? null,
            'bank_ifsc_code'  => $validated['bank_ifsc_code'] ?? null,
            'created_by'   => $auth->id,
        ]);

        return response()->json([
            'message' => ucfirst($validated['role']) . ' created successfully',
            'user' => $user
        ], 201);
    }

    public function usersByRole()
    {
        $auth = auth()->user();
        if (!$auth || $auth->role !== 'admin') {
            return response()->json([
                'message' => 'Only admin can view users'
            ], 403);
        }

        return response()->json([
            'message' => 'Users fetched successfully',
            'data' => [
                'admins' => User::where('role', 'admin')->get(),
                'leaders' => User::where('role', 'leader')->get(),
                'advisers' => User::where('role', 'adviser')->get(),
                'customers' => User::where('role', 'customer')->get(),
            ]
        ]);
    }

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

    /**
     * Update User
     */
    public function update(Request $request, $id)
    {
        $auth = auth()->user();

        if (!$auth) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Admin can update anyone
        // Others can update only their created users
        if ($auth->role !== 'admin' && $user->created_by !== $auth->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $rules = [
            'name' => 'sometimes|required|string|max:200',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'age' => 'nullable|integer|min:18',
            'gender' => 'nullable|in:male,female,others',
            'contact_no' => 'nullable|string|max:15',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'address' => 'nullable|string',
            'pin_code' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'bank_name' => 'nullable|string',
            'bank_branch' => 'nullable|string',
            'bank_account_no' => 'nullable|string',
            'bank_ifsc_code' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        // Image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('leaders', 'public');
            $validated['profile_image'] = $imagePath;
        }

        // Password update
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }

    /**
     * Delete User
     */
    public function destroy($id)
    {
        $auth = auth()->user();

        if (!$auth) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Admin can delete anyone
        // Others can delete only their created users
        if ($auth->role !== 'admin' && $user->created_by !== $auth->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
