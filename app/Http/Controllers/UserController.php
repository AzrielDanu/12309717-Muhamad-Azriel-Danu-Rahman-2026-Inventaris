<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the admins.
     */
    public function adminIndex()
    {
        $users = User::where('role', 'admin')->orderBy('created_at', 'desc')->get();
        return view('admin.users.index_admin', compact('users'));
    }

    /**
     * Display a listing of the operators.
     */
    public function operatorIndex()
    {
        $users = User::whereIn('role', ['operator', 'staff'])->orderBy('created_at', 'desc')->get();
        return view('admin.users.index_operator', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:admin,staff',
        ]);

        // Create user with temp password
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make('temporary'),
        ]);

        // Generate final password: 4 chars of email + his ID
        $prefix = substr($request->email, 0, 4);
        $generatedPassword = $prefix . $user->id;

        $user->update([
            'password' => Hash::make($generatedPassword)
        ]);

        $route = $request->role === 'admin' ? 'admin.users.admins' : 'admin.users.operators';

        return redirect()->route($route)->with('success', "User created successfully.")->with('generated_password', $generatedPassword);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,staff',
            'new_password' => 'nullable|string|min:4',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }

        $user->update($data);

        $route = $request->role === 'admin' ? 'admin.users.admins' : 'admin.users.operators';
        return redirect()->route($route)->with('success', 'User updated successfully.');
    }

    /**
     * Reset the user's password to the initial rule.
     */
    public function resetPassword(User $user)
    {
        $prefix = substr($user->email, 0, 4);
        $newPassword = $prefix . $user->id;

        $user->update([
            'password' => Hash::make($newPassword)
        ]);

        return back()->with('success', "Password reset successfully.")->with('generated_password', $newPassword);
    }

    /**
     * Update the authenticated user's own profile.
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'new_password' => 'nullable|string|min:4',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }

        $user->update($data);

        return back()->with('profile_success', 'Your profile has been updated successfully.');
    }

    /**
     * Export admin users to Excel.
     */
    public function exportAdmins()
    {
        return Excel::download(new UsersExport('admin'), 'admin-accounts-' . '.xlsx');
    }

    /**
     * Export operator/staff users to Excel.
     */
    public function exportOperators()
    {
        return Excel::download(new UsersExport('staff'), 'operator-accounts-' . '.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}