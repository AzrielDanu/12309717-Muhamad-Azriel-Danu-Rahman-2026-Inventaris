@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Categories</h1>
            <p class="text-slate-500 mt-1">Manage your item categories and divisions.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition-all duration-200 shadow-sm hover:shadow-indigo-200">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Category
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 flex items-center p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl animate-in fade-in slide-in-from-top-4 duration-300">
            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Name</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider">Division</th>
                        <th class="py-2 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Items</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($categories as $category)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                            <td class="py-4 px-6">
                                <span class="text-sm font-semibold text-slate-700">{{ $category->name }}</span>
                            </td>
                            <td class="py-4 px-6">
                                @php
                                    $divisionColors = [
                                        'sarpras' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                                        'tefa' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        'tatausaha' => 'bg-rose-50 text-rose-700 border-rose-100',
                                    ];
                                    $colorClass = $divisionColors[strtolower($category->division)] ?? 'bg-slate-50 text-slate-700 border-slate-100';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border uppercase {{ $colorClass }}">
                                    {{ $category->division }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600 text-xs font-bold">
                                    {{ $category->items_count }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors" title="Edit Category">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($categories->isEmpty())
            <div class="px-6 py-12 text-center">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
                <h3 class="text-slate-900 font-medium tracking-tight">No categories found</h3>
                <p class="text-slate-500 text-sm mt-1">Get started by creating your first category.</p>
                <a href="{{ route('admin.categories.create') }}" class="mt-4 inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                    Add Category <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        @endif
    </div>
@endsection