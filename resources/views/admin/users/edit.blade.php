
@extends('layouts.app')

@section('title', 'Edit User - ' . $user->name)

@section('content')
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <a href="{{ route($user->role === 'admin' ? 'admin.users.admins' : 'admin.users.operators') }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Edit User</h1>
        </div>
        <p class="text-slate-500 ml-11">Updating account for <span class="font-semibold text-slate-700">{{ $user->name }}</span> (ID: #{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }})</p>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-2">
                    <label for="name" class="text-sm font-semibold text-slate-700">Full Name</label>
                    <input type="text" name="name" id="name" required value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-slate-50/50">
                    @error('name')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="email" class="text-sm font-semibold text-slate-700">Email Address</label>
                    <input type="email" name="email" id="email" required value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-slate-50/50">
                    @error('email')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="role" class="text-sm font-semibold text-slate-700">System Role</label>
                    <select name="role" id="role" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-slate-50/50">
                        <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>Operator</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                    @error('role')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <div class="mb-4">
                        <label for="new_password" class="text-sm font-semibold text-slate-700">Change Password</label>
                        <p class="text-xs text-slate-400 mb-2">Leave blank if you don't want to change the password.</p>
                        <input type="password" name="new_password" id="new_password"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-slate-50/50"
                            placeholder="Enter new password (optional)">
                        @error('new_password')
                            <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-4 flex items-center gap-3">
                    <button type="submit"
                        class="flex-1 bg-indigo-600 text-white font-bold py-3.5 px-6 rounded-xl hover:bg-indigo-700 transition-all duration-200 shadow-lg shadow-indigo-100 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Update Account
                    </button>
                    <a href="{{ route($user->role === 'admin' ? 'admin.users.admins' : 'admin.users.operators') }}"
                        class="px-6 py-3.5 bg-slate-50 text-slate-600 font-bold rounded-xl hover:bg-slate-100 transition-all border border-slate-100">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
