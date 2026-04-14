@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.items.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to inventory
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Edit Item Details</h1>
            <p class="text-slate-500 mt-1">Update the information for <span class="text-indigo-600 font-semibold">{{ $item->name }}</span>.</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <form method="POST" action="{{ route('admin.items.update', $item) }}" class="p-8">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Item Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none placeholder:text-slate-400" 
                            required>
                        @error('name')
                            <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">Category</label>
                        <select name="category_id" id="category_id" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none bg-white font-medium text-slate-700 select-box" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} ({{ strtoupper($category->division) }})
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="total" class="block text-sm font-semibold text-slate-700 mb-2">Total Quantity</label>
                            <input type="number" name="total" id="total" value="{{ old('total', $item->total) }}" min="0"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none" 
                                required>
                            @error('total')
                                <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="repair" class="block text-sm font-semibold text-slate-700 mb-2">Add to Repairing</label>
                            <div class="relative">
                                <input type="number" name="repair" id="repair" value="0"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none placeholder:text-slate-400">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 py-1 px-2.5 bg-rose-50 text-rose-600 rounded-lg text-xs font-bold border border-rose-100">
                                    Current: {{ $item->repair }}
                                </span>
                            </div>
                            <p class="mt-1.5 text-[11px] text-slate-400 italic">Enter a value to increment current repair count.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end gap-4 pb-2">
                    <a href="{{ route('admin.items.index') }}" 
                        class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="px-8 py-3 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:shadow-indigo-200">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection