<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LendingsExport;
use Maatwebsite\Excel\Facades\Excel;

class LendingController extends Controller
{
    

    public function index()
    {
        $lendings = Lending::with(['item', 'user'])->orderBy('created_at', 'desc')->get();
        return view('staff.lendings.index', compact('lendings'));
    }

    public function create()
    {
        $items = Item::all();
        return view('staff.lendings.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.total' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $signature = 'TRX-' . time() . rand(100, 999);
        $userId = auth()->id();

        try {
            DB::transaction(function () use ($request, $signature, $userId) {

                $requestedTotals = [];
                foreach ($request->items as $itemData) {
                    $requestedTotals[$itemData['item_id']] = ($requestedTotals[$itemData['item_id']] ?? 0) + $itemData['total'];
                }

                foreach ($requestedTotals as $itemId => $total) {
                    $item = Item::findOrFail($itemId);

                    // Calculate availability: Total - Repair - Currently Borrowed
                    $borrowed = $item->lendings()->where('status', 'borrowed')->sum('total');
                    $available = $item->total - $item->repair - $borrowed;

                    if ($available < $total) {
                        throw new \Exception("Insufficient stock for item: {$item->name}. Available: {$available}");
                    }

                    Lending::create([
                        'name' => $request->name,
                        'item_id' => $itemId,
                        'user_id' => $userId,
                        'total' => $total,
                        'signature' => $signature,
                        'description' => $request->description,
                        'status' => 'borrowed'
                    ]);
                }
            });

            return redirect()->route('staff.lendings.index')->with('success', 'Lending records created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function returnItem(Lending $lending)
    {
        if ($lending->status === 'returned') {
            return back()->with('error', 'This item has already been returned.');
        }

        $lending->update([
            'status' => 'returned',
            'return_date' => now()
        ]);

        return back()->with('success', 'Item marked as returned successfully.');
    }

    public function destroy(Lending $lending){
        $lending->delete();
        return back()->with('success', 'Item Successfully removed');
    }

     public function export()
    {
        return Excel::download(new LendingsExport, 'lendings-' . '.xlsx');
    }

}