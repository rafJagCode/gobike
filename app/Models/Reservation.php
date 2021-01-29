<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateFrom',
        'dateTo',
        'status',
        'user_id',
        'productId'
    ];
    
    public function product()
    {
        return $this->hasOne(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
