<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'total',
        'repair'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lendings()
    {
        return $this->hasMany(Lending::class);
    }

     public function getAvailableAttribute()
    {
        $borrowed = $this->lendings()->where('status', 'borrowed')->sum('total');
        return $this->total - $this->repair - $borrowed;
    }
}
