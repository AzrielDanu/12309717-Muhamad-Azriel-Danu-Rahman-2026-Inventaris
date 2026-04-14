@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Items Management</h1>

    <a href="{{ route('admin.items.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Add New Item
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border-b">Name</th>
                    <th class="px-4 py-2 border-b">Category</th>
                    <th class="px-4 py-2 border-b">Total</th>
                    <th class="px-4 py-2 border-b">Repair</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $item->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $item->category->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border-b">{{ $item->total }}</td>
                        <td class="px-4 py-2 border-b">{{ $item->repair ?? 0 }}</td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('admin.items.edit', $item) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm mr-2">
                                Edit
                            </a>
                            <form action="{{ route('admin.items.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 border-b text-center">No items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection