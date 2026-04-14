<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'name',
        'total',
        'signature',
        'description',
        'status',
        'return_date',
    ];

    protected $casts = [
        'return_date' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($lending) {
            if ($lending->isDirty('status') && $lending->status === 'returned') {
                $lending->return_date = now();
            }
        });
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}