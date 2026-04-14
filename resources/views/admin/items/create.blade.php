@extends('layouts.app')

@section('title', 'Create Item')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.items.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to inventory
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Add New Item</h1>
            <p class="text-slate-500 mt-1">Add a new item to your inventory records.</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <form method="POST" action="{{ route('admin.items.store') }}" class="p-8">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Item Name</label>
                        <input type="text" name="name" id="name" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none placeholder:text-slate-400" 
                            placeholder="e.g. MacBook Pro M2" required>
                        @error('name')
                            <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">Category</label>
                        <select name="category_id" id="category_id" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none bg-white font-medium text-slate-700 select-box" required>
                            <option value="" disabled selected>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }} ({{ strtoupper($category->division) }})</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="total" class="block text-sm font-semibold text-slate-700 mb-2">Initial Quantity</label>
                        <div class="relative">
                            <input type="number" name="total" id="total" min="0"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none placeholder:text-slate-400" 
                                placeholder="0" required>
                            <div class="absolute inset-y-0 right-0 py-3 pr-4 pointer-events-none flex items-center">
                                <span class="text-slate-400 text-sm">Units</span>
                            </div>
                        </div>
                        @error('total')
                            <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end gap-4 pb-2">
                    <a href="{{ route('admin.items.index') }}" 
                        class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="px-8 py-3 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:shadow-indigo-200">
                        Add to Inventory
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection