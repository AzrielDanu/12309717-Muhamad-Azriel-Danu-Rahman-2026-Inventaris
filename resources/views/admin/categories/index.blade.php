@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Categories Management</h1>

    <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Add New Category
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border-b">Name</th>
                    <th class="px-4 py-2 border-b">Division</th>
                    <th class="px-4 py-2 border-b">Items Count</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $category->name }}</td>
                        <td class="px-4 py-2 border-b">{{ ucfirst($category->division) }}</td>
                        <td class="px-4 py-2 border-b">{{ $category->items_count }}</td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 border-b text-center">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection