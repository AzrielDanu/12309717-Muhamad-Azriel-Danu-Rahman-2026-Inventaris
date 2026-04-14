<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ItemsExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
     * Fetch all items with their categories.
     */
    public function collection()
    {
        return Item::with('category')
            ->orderBy('category_id')
            ->get()
            ->map(function ($item) {
                return [
                    'Category'     => $item->category->name ?? '-',
                    'Name Item'    => $item->name,
                    'Total'        => $item->total,
                    'Repair Total' => $item->repair > 0 ? $item->repair : '-',
                    'Last Updated' => $item->updated_at->format('M d, Y'),
                ];
            });
    }

    /**
     * Define header row.
     */
    public function headings(): array
    {
        return [
            'Category',
            'Name Item',
            'Total',
            'Repair Total',
            'Last Updated',
        ];
    }

    /**
     * Make the header row bold.
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * Set column widths to match the expected format.
     */
    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 20,
            'C' => 10,
            'D' => 15,
            'E' => 18,
        ];
    }
}