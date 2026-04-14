@extends('layouts.app')

@section('title', 'Items')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Items Inventory</h1>
            <p class="text-slate-500 mt-1">Manage and track your inventory across all categories.</p>
        </div>
        <div class="flex items-center gap-3">
             <a href="{{ route('admin.items.export') }}"
                class="inline-flex items-center px-4 py-2.5 bg-emerald-600 text-white font-medium rounded-xl hover:bg-emerald-700 transition-all duration-200 shadow-sm hover:shadow-emerald-200">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export Excel
            </a>
            
            <a href="{{ route('admin.items.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:shadow-indigo-200">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Item
            </a>
        </div>
    </div>

    @if (session('success'))
        <div
            class="mb-6 flex items-center p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl animate-in fade-in slide-in-from-top-4 duration-300">
            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Item Name</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Category</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Total
                            Stock</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">
                            Available</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">
                            Repairing</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Lendings
                        </th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($items as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                            <td class="py-4 px-6">
                                <span class="text-sm font-semibold text-slate-700 block">{{ $item->name }}</span>
                                <span class="text-xs text-slate-400">ID:
                                    #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                    {{ $item->category->name }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span
                                    class="inline-flex items-center justify-center min-w-[3rem] h-8 px-2 rounded-lg bg-slate-50 text-slate-600 text-sm font-bold border border-slate-100">
                                    {{ $item->total }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span
                                    class="inline-flex items-center justify-center min-w-[3rem] h-8 px-2 rounded-lg bg-emerald-50 text-emerald-700 text-sm font-bold border border-emerald-100">
                                    {{ $item->available }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if ($item->repair > 0)
                                    <span
                                        class="inline-flex items-center justify-center min-w-[3rem] h-8 px-2 rounded-lg bg-rose-50 text-rose-700 text-sm font-bold border border-rose-100">
                                        {{ $item->repair }}
                                    </span>
                                @else
                                    <span class="text-slate-300 text-sm font-medium">0</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('admin.items.lendings', $item) }}"
                                    class="inline-flex items-center justify-center min-w-[3rem] h-8 px-2 rounded-lg bg-blue-50 text-blue-700 text-sm font-bold border border-blue-100 hover:bg-blue-100 hover:scale-105 transition-all duration-200">
                                    {{ $item->lendings->sum('total') }}
                                </a>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.items.edit', $item) }}"
                                        class="p-2 text-slate-400 hover:text-indigo-600 transition-colors"
                                        title="Edit Item">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.items.destroy', $item) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-slate-400 hover:text-rose-600 transition-colors"
                                            onclick="return confirm('Delete this item?')" title="Delete Item">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($items->isEmpty())
            <div class="px-6 py-12 text-center">
                <div
                    class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h3 class="text-slate-900 font-medium tracking-tight">No items found</h3>
                <p class="text-slate-500 text-sm mt-1">Start adding items to your inventory.</p>
                <a href="{{ route('admin.items.create') }}"
                    class="mt-4 inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                    Add Item <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        @endif
    </div>
@endsection