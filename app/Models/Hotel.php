<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'hotel_image_url', 'lokasi', 'harga', 'rating', 'kualitas_layanan', 'fasilitas', 'kemudahan_aksesibilitas'
    ];

    protected $casts = [
        'fasilitas' => 'array',
        'kualitas_layanan' => 'array',
        'kemudahan_aksesibilitas' => 'array',
    ];

    protected $dispatchesEvents = [
        'updated' => \App\Events\HotelUpdated::class,
    ];

    public function alternatives()
    {
        return $this->hasMany(Alternative::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function ranking()
    {
        return $this->hasOne(Ranking::class);
    }
}
