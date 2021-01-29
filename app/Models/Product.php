<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'availability', 'description', 'img'
    ];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
