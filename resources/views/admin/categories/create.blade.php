@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to categories
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Create New Category</h1>
            <p class="text-slate-500 mt-1">Fill in the details below to add a new category to your inventory.</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <form method="POST" action="{{ route('admin.categories.store') }}" class="p-8">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Category Name</label>
                        <input type="text" name="name" id="name" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none placeholder:text-slate-400" 
                            placeholder="e.g. Alat Elektronik" required>
                        @error('name')
                            <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="division" class="block text-sm font-semibold text-slate-700 mb-2">Division</label>
                        <select name="division" id="division" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none bg-white font-medium text-slate-700 select-box" required>
                            <option value="" disabled selected>Select a division</option>
                            <option value="sarpras">SARPRAS (Sarana & Prasarana)</option>
                            <option value="tefa">TEFA (Teaching Factory)</option>
                            <option value="tatausaha">TATAUSAHA</option>
                        </select>
                        @error('division')
                            <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end gap-4 pb-2">
                    <a href="{{ route('admin.categories.index') }}" 
                        class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="px-8 py-3 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:shadow-indigo-200">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection