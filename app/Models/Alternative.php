<?php

namespace App\Models;

use App\Models\Hotel;
use App\Models\Ranking;
use App\Models\Criteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alternative extends Model
{
    use HasFactory;
    protected $fillable = ['hotel_id', 'criteria_id', 'nilai', 'c1', 'c2', 'c3', 'c4', 'c5'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function rankings()
    {
        return $this->hasMany(Ranking::class);
    }
}
