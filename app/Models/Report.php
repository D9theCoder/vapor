<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'flood_location_id',
        'user_id',
        'subdistrict',
        'description'
    ];

    public function floodLocations(){
        return $this->belongsTo(FloodLocation::class, 'flood_location_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}