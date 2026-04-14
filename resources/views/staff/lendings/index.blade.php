@extends('layouts.app')

@section('title', 'Lending Records')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Lending Records</h1>
        <p class="text-slate-500 mt-1">Manage all lending transactions.</p>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-600 rounded-2xl flex items-center shadow-sm animate-in fade-in duration-300">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 bg-rose-50 border border-rose-100 text-rose-600 rounded-2xl flex items-center shadow-sm animate-in fade-in duration-300">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium text-sm">{{ session('error') }}</span>
        </div>
    @endif

    <div class="mb-6 flex items-center gap-2">
         <a href="{{ route('staff.lendings.export') }}"
                class="inline-flex items-center px-4 py-2.5 bg-emerald-600 text-white font-medium rounded-xl hover:bg-emerald-700 transition-all duration-200 shadow-sm hover:shadow-emerald-200">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export Excel
            </a>
        <a href="{{ route('staff.lendings.create') }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Record New Lending
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8">
            @if($lendings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <th class="text-left py-3 px-4 font-semibold text-slate-700">Borrower</th>
                                <th class="text-left py-3 px-4 font-semibold text-slate-700">Item</th>
                                <th class="text-left py-3 px-4 font-semibold text-slate-700">Quantity</th>
                                <th class="text-left py-3 px-4 font-semibold text-slate-700">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-slate-700">Date</th>
                                <th class="text-left py-3 px-4 font-semibold text-slate-700">Return Date</th>
                                <th class="text-left py-3 px-4 font-semibold text-slate-700">Edited By</th>
                                <th class="text-center py-3 px-4 font-semibold text-slate-700">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lendings as $lending)
                                <tr class="border-b border-slate-50 hover:bg-slate-50">
                                    <td class="py-3 px-4 text-slate-800">{{ $lending->name }}</td>
                                    <td class="py-3 px-4 text-slate-800">{{ $lending->item->name }}</td>
                                    <td class="py-3 px-4 text-slate-800">{{ $lending->total }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $lending->status === 'borrowed' ? 'bg-amber-100 text-amber-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($lending->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-slate-600">{{ $lending->created_at->format('M d, Y') }}</td>
                                    <td class="py-3 px-4 text-slate-600">{{ $lending->return_date ? $lending->return_date->format('M d, Y H:i') : '-' }}</td>
                                    <td class="py-3 px-4 text-slate-600">{{ $lending->user->name }}</td>
                                    <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        @if ($lending->status === 'borrowed')
                                            <form action="{{ route('staff.lendings.return', $lending) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors" title="Mark as Returned">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($lending->status === 'returned')
                                            -
                                        @endif
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-12 h-12 mx-auto text-slate-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-lg font-medium text-slate-900 mb-1">No lending records</h3>
                    <p class="text-slate-500">Get started by recording your first lending transaction.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection