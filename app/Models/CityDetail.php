<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityDetail extends Model
{
    use HasFactory;

    protected $table = 'city_details';

    protected $fillable = [
        'flood_location_id',
        'kelurahan',
        'latitude',
        'longitude',
        'indeksBanjir',
        'kategori',
    ];

    protected static function booted()
    {
        static::creating(function ($cityDetail) {
            // Set kategori based on indeksBanjir
            if ($cityDetail->indeksBanjir < 1.5) {
                $cityDetail->kategori = 'Rendah';
            } elseif ($cityDetail->indeksBanjir <= 1.9) {
                $cityDetail->kategori = 'Sedang';
            } elseif ($cityDetail->indeksBanjir > 1.9) {
                $cityDetail->kategori = 'Tinggi';
            }
        });

        static::created(function ($cityDetail) {
            $floodLocation = $cityDetail->floodLocations;
            $floodLocation->increment('flood_count');
        });
    }

    public function floodLocations()
    {
        return $this->belongsTo(FloodLocation::class, 'flood_location_id');
    }
}
