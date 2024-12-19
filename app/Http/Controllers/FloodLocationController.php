<?php

namespace App\Http\Controllers;

use App\Models\FloodLocation;
use Illuminate\Http\Request;

class FloodLocationController extends Controller
{
    public function index()
    {
        $floodLocations = FloodLocation::with('cityDetails')->get();

        return view('test', compact('floodLocations'));
    }

    public function getFloodLocations()
    {
        try {
            $floodLocations = FloodLocation::all(['latitude', 'longitude', 'name as city', 'flood_count as count']);
            return response()->json($floodLocations);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getCityDetails()
    {
        try {
            $cities = FloodLocation::with('cityDetails')->get();
            $cityDetails = [];
    
            foreach ($cities as $city) {
                $cityDetails[$city->name] = $city->cityDetails->map(function ($detail) {
                    return [
                        'lnglat' => [$detail->longitude, $detail->latitude],
                        'kelurahan' => $detail->kelurahan,
                        'indeksBanjir' => $detail->indeksBanjir,
                        'kategori' => $detail->kategori
                    ];
                });
            }
    
            return response()->json($cityDetails);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
