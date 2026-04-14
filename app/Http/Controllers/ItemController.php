<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $items = Item::with('category')->orderBy('created_at', 'desc')->get();
        return view ('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //  
        $categories = Category::all();
        return view ('admin.items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'total' => 'required'
        ]);

        Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'total' => $request->total
        ]);

        return redirect()->route('admin.items.index')->with('success', 'items successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(Item $item)
    {
        //
        $item = Item::findOrFail($item->id);
        $categories = Category::all();
        return view('admin.items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
        $updateRepair = $request->repair ? $item->repair + $request->repair : $item->repair;

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'total' => 'required|integer|min:0',
        ]);

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'total' => $request->total,
            'repair' => $updateRepair,
        ]);

        return redirect()->route('admin.items.index')->with('success', 'Item updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Item deleted successfully.');
    }
}
