@extends('layouts.app')

@section('title', 'Item Lendings - ' . $item->name)

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <a href="{{ route('admin.items.index') }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-slate-800">Lending Records</h1>
            </div>
            <p class="text-slate-500 ml-11">Viewing all lending history for <span class="font-semibold text-slate-700">{{ $item->name }}</span></p>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="px-4 py-2 bg-white border border-slate-100 rounded-xl shadow-sm">
                <span class="text-xs font-medium text-slate-400 uppercase tracking-wider block">Total Borrowed</span>
                <span class="text-lg font-bold text-slate-700">{{ $item->lendings->sum('total') }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Transaction ID</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Borrowed By</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Quantity</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Date Borrowed</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Return Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($item->lendings as $lending)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                            <td class="py-4 px-6">
                                <span class="text-sm font-mono font-medium text-slate-600">{{ $lending->signature ?? 'N/A' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center mr-3">
                                        <span class="text-xs font-bold text-indigo-600">{{ strtoupper(substr($lending->user->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-semibold text-slate-700 block">{{ $lending->user->name }}</span>
                                        <span class="text-xs text-slate-400">{{ $lending->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-50 text-slate-600 text-sm font-bold border border-slate-100">
                                    {{ $lending->total }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                @if ($lending->status === 'borrowed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-2"></span>
                                        Borrowed
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                        Returned
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-sm text-slate-600">{{ $lending->created_at->format('M d, Y H:i') }}</span>
                            </td>
                            <td class="py-4 px-6">
                                @if ($lending->return_date)
                                    <span class="text-sm text-slate-600">{{ $lending->return_date->format('M d, Y H:i') }}</span>
                                @else
                                    <span class="text-xs font-medium text-slate-400 italic">Expected soon</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-slate-900 font-medium tracking-tight">No records found</h3>
                                <p class="text-slate-500 text-sm mt-1">This item hasn't been lent out yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection