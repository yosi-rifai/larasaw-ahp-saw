<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id', 'score'
    ];

    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }
}
