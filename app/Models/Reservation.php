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
        'userId',
        'productId'
    ];
    
    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
