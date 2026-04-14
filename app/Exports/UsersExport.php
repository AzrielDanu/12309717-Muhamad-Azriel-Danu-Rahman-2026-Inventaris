<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    protected string $role;

    public function __construct(string $role)
    {
        $this->role = $role;
    }

    public function collection()
    {
        $roles = $this->role === 'staff' ? ['staff', 'operator'] : [$this->role];

        return User::whereIn('role', $roles)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($user) {
                // The default password rule: first 4 chars of email + user ID
                $defaultPassword = substr($user->email, 0, 4) . $user->id;
                $isDefault = Hash::check($defaultPassword, $user->password);

                return [
                    'Name'     => $user->name,
                    'Email'    => $user->email,
                    'Password' => $isDefault
                        ? $defaultPassword
                        : 'This account already edited the password',
                ];
            });
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Password'];
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
            'A' => 22,
            'B' => 28,
            'C' => 42,
        ];
    }
}