<?php

namespace App\Exports;

use App\Models\Lending;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LendingsExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return Lending::with(['item', 'user'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($lending) {
                return [
                    'Item'        => $lending->item->name ?? '-',
                    'Total'       => $lending->total,
                    'Name'        => $lending->name,
                    'Ket.'        => $lending->description ?? '-',
                    'Date'        => $lending->created_at->format('M d, Y'),
                    'Return Date' => $lending->return_date
                                        ? $lending->return_date->format('M d, Y')
                                        : '-',
                    'Edited By'   => $lending->user->name ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return ['Item', 'Total', 'Name', 'Ket.', 'Date', 'Return Date', 'Edited By'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 8,
            'C' => 18,
            'D' => 22,
            'E' => 16,
            'F' => 16,
            'G' => 22,
        ];
    }
}