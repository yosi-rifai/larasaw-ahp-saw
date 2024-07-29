<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'user_id', 'rating', 'review'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}