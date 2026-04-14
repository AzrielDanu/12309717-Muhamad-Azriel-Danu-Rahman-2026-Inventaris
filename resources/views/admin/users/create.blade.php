@extends('layouts.app')

@section('title', 'Add New User')

@section('content')
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <a href="{{ url()->previous() }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Add New User</h1>
        </div>
        <p class="text-slate-500 ml-11">Fill in the details to create a new system user. Password will be generated automatically.</p>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <form method="POST" action="{{ route('admin.users.store') }}" class="p-8 space-y-6">
                @csrf
                
                <div class="space-y-2">
                    <label for="name" class="text-sm font-semibold text-slate-700">Full Name</label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-slate-50/50"
                        placeholder="Azriel Danu">
                    @error('name')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="email" class="text-sm font-semibold text-slate-700">Email Address</label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-slate-50/50"
                        placeholder="admin@example.com">
                    @error('email')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="role" class="text-sm font-semibold text-slate-700">System Role</label>
                    <select name="role" id="role" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-slate-50/50">
                        <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Operator</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                    @error('role')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 flex items-center gap-3">
                    <button type="submit"
                        class="flex-1 bg-indigo-600 text-white font-bold py-3.5 px-6 rounded-xl hover:bg-indigo-700 transition-all duration-200 shadow-lg shadow-indigo-100 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Create Account
                    </button>
                    <a href="{{ url()->previous() }}"
                        class="px-6 py-3.5 bg-slate-50 text-slate-600 font-bold rounded-xl hover:bg-slate-100 transition-all border border-slate-100">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        
    </div>
@endsection