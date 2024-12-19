<?php

namespace App\Http\Controllers;

use App\Models\CityDetail;
use App\Models\FloodLocation;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $floodLocations = FloodLocation::all();
        return view('support', ['floodLocations' => $floodLocations]);
    }

    public function store_report(Request $request)
    {
        // Validate data input with custom messages
        $validated = $request->validate([
            'city_name' => 'required|string|exists:flood_locations,name',
            'subdistrict' => 'required|string',
            'description' => 'required|string|min:5|max:1000'
        ], [
            'city_name.required' => 'Please select an administrative city',
            'city_name.exists' => 'The selected city is not in our database',
            'subdistrict.required' => 'Subdistrict field is required',
            'description.required' => 'Description is required',
            'description.min' => 'Description must be at least 5 characters',
            'description.max' => 'Description cannot exceed 1000 characters'
        ]);

        // Find flood location by name
        $floodLocation = FloodLocation::where('name', $validated['city_name'])->first();

        // Create the report
        Report::create([
            'flood_location_id' => $floodLocation->id,
            'user_id' => Auth::user()->id,
            'subdistrict' => $validated['subdistrict'],
            'description' => $validated['description'],
        ]);

        return redirect()->back()->with('success', 'Report submitted successfully!');
    }

    public function store_flood_point(Request $request)
    {

        // Validate data input
        $validated = $request->validate([
            'flood_location_id' => 'required|exists:flood_locations,id',
            'kelurahan' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'indeksBanjir' => 'required|numeric'
        ], [
            'flood_location_id.required' => 'Please select an administrative city',
            'kelurahan.required' => 'Kelurahan field is required',
            'latitude.required' => 'Latitude field is required',
            'latitude.numeric' => 'Latitude must be a number',
            'longitude.required' => 'Longitude field is required',
            'longitude.numeric' => 'Longitude must be a number',
            'indeksBanjir.required' => 'Flood index field is required',
            'indeksBanjir.numeric' => 'Flood index must be a number'
        ]);

        // Create the city detail
        CityDetail::create([
            'flood_location_id' => $validated['flood_location_id'],
            'kelurahan' => $validated['kelurahan'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'indeksBanjir' => $validated['indeksBanjir']
        ]);

        return redirect()->back()->with('success', 'Flood incident point submitted successfully!');
    }
}
