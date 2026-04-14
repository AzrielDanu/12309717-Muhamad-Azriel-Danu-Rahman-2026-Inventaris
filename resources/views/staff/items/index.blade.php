@extends('layouts.app')

@section('title', 'Items')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Items Inventory</h1>
            <p class="text-slate-500 mt-1">Manage and track your inventory across all categories.</p>
        </div>
        <div class="flex items-center gap-3">
                
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection