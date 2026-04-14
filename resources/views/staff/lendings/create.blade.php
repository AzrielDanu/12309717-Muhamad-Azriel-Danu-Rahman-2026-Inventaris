@extends('layouts.app')

@section('title', 'Record Lending')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('staff.lendings.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to records
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Record New Lending</h1>
            <p class="text-slate-500 mt-1">Register items being borrowed from the inventory.</p>
        </div>

        @if (session('error'))
            <div class="mb-6 p-4 bg-rose-50 border border-rose-100 text-rose-600 rounded-2xl flex items-center shadow-sm animate-in fade-in duration-300">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <form method="POST" action="{{ route('staff.lendings.store') }}" class="p-8">
                @csrf
                <div class="space-y-8">
                    <!-- General Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Borrower Name (Student/Staff)</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none placeholder:text-slate-400" 
                                placeholder="e.g. John Doe" required>
                            @error('name')
                                <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Recording Staff</label>
                            <div class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-100 text-slate-500 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                    </div>

                    <hr class="border-slate-100">

                    <!-- Items List -->
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Lending Items</h3>
                            <button type="button" onclick="addItemRow()" 
                                class="inline-flex items-center text-xs font-bold text-indigo-600 hover:text-indigo-700 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                ADD ITEM
                            </button>
                        </div>

                        <div id="items-wrapper" class="space-y-3">
                            <!-- Initial Row -->
                            <div class="flex gap-3 item-row animate-in slide-in-from-left duration-300">
                                <div class="flex-grow">
                                    <select name="items[0][item_id]" 
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none bg-white font-medium text-slate-700" required>
                                        <option value="" disabled selected>Select an item</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }} (Available: {{ $item->total - $item->repair - $item->lendings()->where('status', 'borrowed')->sum('total') }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-32">
                                    <input type="number" name="items[0][total]" min="1" placeholder="Qty" required
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none">
                                </div>
                                <div class="w-12 h-12 flex-shrink-0">
                                    <!-- Placeholder for alignment -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-slate-100">

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Notes (Optional)</label>
                        <textarea name="description" id="description" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none placeholder:text-slate-400" 
                            placeholder="Add any specific details about this lending..."></textarea>
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end gap-4 pb-2">
                    <a href="{{ route('staff.lendings.index') }}" 
                        class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="px-8 py-3 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:shadow-indigo-200">
                        Record Transaction
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let index = 1;
        const itemsWrapper = document.getElementById('items-wrapper');
        const itemOptions = `@foreach ($items as $item)
            <option value="{{ $item->id }}">{{ $item->name }} (Available: {{ $item->total - $item->repair - $item->lendings()->where('status', 'borrowed')->sum('total') }})</option>
        @endforeach`;

        function addItemRow() {
            const row = document.createElement('div');
            row.classList.add('flex', 'gap-3', 'item-row', 'animate-in', 'slide-in-from-left', 'duration-300');

            row.innerHTML = `
                <div class="flex-grow">
                    <select name="items[${index}][item_id]" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none bg-white font-medium text-slate-700" required>
                        <option value="" disabled selected>Select an item</option>
                        ${itemOptions}
                    </select>
                </div>
                <div class="w-32">
                    <input type="number" name="items[${index}][total]" min="1" placeholder="Qty" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none">
                </div>
                <div class="w-12 h-12 flex-shrink-0">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" 
                        class="w-full h-full flex items-center justify-center bg-rose-50 text-rose-500 rounded-xl hover:bg-rose-100 transition-colors border border-rose-100">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            `;

            itemsWrapper.appendChild(row);
            index++;
        }
    </script>
@endsection