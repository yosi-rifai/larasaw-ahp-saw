<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'bobot', 'jenis'
    ];

    public function alternatives()
    {
        return $this->hasMany(Alternative::class);
    }
}
