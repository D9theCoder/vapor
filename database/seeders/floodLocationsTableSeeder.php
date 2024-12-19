<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\FloodLocation;
use App\Models\CityDetail;

class floodLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['name' => 'Jakarta Utara',
            'latitude' => -6.138414, 
            'longitude' => 106.863956, 
            'flood_count' => 21, 
            'city_details' => [
                ['kelurahan' => 'SEMPER BARAT', 'latitude' => -6.12292, 'longitude' => 106.92662, 'indeksBanjir' => 1.8, 'kategori' => 'Sedang'],
                ['kelurahan' => 'SEMPER TIMUR', 'latitude' => -6.12093, 'longitude' => 106.93517, 'indeksBanjir' => 1.8, 'kategori' => 'Sedang'],
                ['kelurahan' => 'SUKAPURA', 'latitude' => -6.15233, 'longitude' => 106.92796, 'indeksBanjir' => 1.8, 'kategori' => 'Sedang'],
                ['kelurahan' => 'PEGANGSAAN DUA', 'latitude' => -6.1626344, 'longitude' => 106.9158465, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'LAGOA', 'latitude' => -6.1140999, 'longitude' => 106.9116460, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'TUGU UTARA', 'latitude' => -6.1224924, 'longitude' => 106.9121406, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'PEJAGALAN', 'latitude' => -6.13550, 'longitude' => 106.78545, 'indeksBanjir' => 2.2, 'kategori' => 'Tinggi'],
                ['kelurahan' => 'PENJARINGAN', 'latitude' => -6.125643, 'longitude' => 106.800759, 'indeksBanjir' => 1.8, 'kategori' => 'Sedang'],
                ['kelurahan' => 'CILINCING', 'longitude' => 106.947666, 'latitude' => -6.121428, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KALIBARU', 'longitude' => 106.915202, 'latitude' => -6.104635, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'MARUNDA', 'longitude' => 106.962424, 'latitude' => -6.113306, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KELAPA GADING BARAT', 'longitude' => 106.897496, 'latitude' => -6.156198, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KELAPA GADING TIMUR', 'longitude' => 106.903398, 'latitude' => -6.166211, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'RAWA BADAK SELATAN', 'longitude' => 106.898972, 'latitude' => -6.131923, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'ANCOL', 'longitude' => 106.844935, 'latitude' => -6.128151, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PADEMANGAN BARAT', 'longitude' => 106.837012, 'latitude' => -6.133919, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PADEMANGAN TIMUR', 'longitude' => 106.850288, 'latitude' => -6.147520, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KAMAL MUARA', 'longitude' => 106.741156, 'latitude' => -6.112755, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KEBON BAWANG', 'longitude' => 106.890119, 'latitude' => -6.119461, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'SUNGAI BAMBU', 'longitude' => 106.885693, 'latitude' => -6.136176, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'TANJUNG PRIOK', 'longitude' => 106.871485, 'latitude' => -6.132055, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'] 

            ]], 
            ['name' => 'Jakarta Barat', 
            'latitude' => -6.1615, 
            'longitude' => 106.7570, 
            'flood_count' => 30, 
            'city_details' => [
                ['kelurahan' => 'CENGKARENG BARAT', 'latitude' => -6.140227, 'longitude' => 106.7235353, 'indeksBanjir' => 1.8, 'kategori' => 'Sedang'],
                ['kelurahan' => 'CENGKARENG TIMUR', 'latitude' => -6.1416616, 'longitude' => 106.7328601, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'DURI KOSAMBI', 'latitude' => -6.16888, 'longitude' => 106.71605, 'indeksBanjir' => 1.8, 'kategori' => 'Sedang'],
                ['kelurahan' => 'KAPUK', 'latitude' => -6.13983, 'longitude' => 106.75331, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'KEDAUNG KALI ANGKE', 'latitude' => -6.1511336, 'longitude' => 106.7575653, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'RAWA BUAYA', 'latitude' => -6.16122, 'longitude' => 106.73901, 'indeksBanjir' => 2.2, 'kategori' => 'Tinggi'],
                ['kelurahan' => 'JELAMBAR BARU', 'latitude' => -6.1489448, 'longitude' => 106.7823051, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'TANJUNG DUREN UTARA', 'latitude' => -6.17116, 'longitude' => 106.78476, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'SEMANAN', 'latitude' => -6.16684, 'longitude' => 106.70250, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'TEGAL ALUR', 'latitude' => -6.1198254, 'longitude' => 106.718693, 'indeksBanjir' => 1.8, 'kategori' => 'Sedang'],
                ['kelurahan' => 'KEDOYA SELATAN', 'latitude' => -6.18190, 'longitude' => 106.75909, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'KEDOYA UTARA', 'latitude' => -6.16781, 'longitude' => 106.76152, 'indeksBanjir' => 1.8, 'kategori' => 'Sedang'],
                ['kelurahan' => 'JOGLO', 'latitude' => -6.21895, 'longitude' => 106.73918, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'KEMBANGAN SELATAN', 'latitude' => -6.18999, 'longitude' => 106.73647, 'indeksBanjir' => 2.0, 'kategori' => 'Tinggi'],
                ['kelurahan' => 'KEMBANGAN UTARA', 'latitude' => -6.17179, 'longitude' => 106.74394, 'indeksBanjir' => 2.0, 'kategori' => 'Tinggi'],
                ['kelurahan' => 'GROGOL', 'longitude' => 106.792766, 'latitude' => -6.160856, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'JELAMBAR', 'longitude' => 106.786805, 'latitude' => -6.166598, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'TANJUNG DUREN SELATAN', 'longitude' => 106.789816, 'latitude' => -6.178820, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'TOMANG', 'longitude' => 106.797150, 'latitude' => -6.182335, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KAMAL', 'longitude' => 106.696928, 'latitude' => -6.101406, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'DURI KEPA', 'longitude' => 106.774860, 'latitude' => -6.169185, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KEBON JERUK', 'longitude' => 106.773595, 'latitude' => -6.195942, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'SUKABUMI UTARA', 'longitude' => 106.778019, 'latitude' => -6.209847, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'MERUYA SELATAN', 'longitude' => 106.733784, 'latitude' => -6.208725, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'MERUYA UTARA', 'longitude' => 106.738207, 'latitude' => -6.197085, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'JATI PULO', 'longitude' => 106.804564, 'latitude' => -6.178344, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KOTA BAMBU UTARA', 'longitude' => 106.798665, 'latitude' => -6.183640, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'MANGGA BESAR', 'longitude' => 106.826872, 'latitude' => -6.149043, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'ANGKE', 'longitude' => 106.800725, 'latitude' => -6.144409, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KERENDANG', 'longitude' => 106.803827, 'latitude' => -6.149655, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah']
            ]],
            ['name' => 'Jakarta Selatan', 
            'latitude' => -6.261493, 
            'longitude' => 106.810600, 
            'flood_count' => 34, 
            'city_details' => [
                ['kelurahan' => 'KUNINGAN BARAT', 'latitude' => -6.23404, 'longitude' => 106.82440, 'indeksBanjir' => 1.8, 'kategori' => 'Sedang'],
                ['kelurahan' => 'MAMPANG PRAPATAN', 'latitude' => -6.25085, 'longitude' => 106.82211, 'indeksBanjir' => 1.8, 'kategori' => 'Sedang'],
                ['kelurahan' => 'PELA MAMPANG', 'latitude' => -6.24694, 'longitude' => 106.81625, 'indeksBanjir' => 1.8, 'kategori' => 'Sedang'],
                ['kelurahan' => 'RAWAJATI', 'latitude' => -6.25884, 'longitude' => 106.85500, 'indeksBanjir' => 2.0, 'kategori' => 'Tinggi'],
                ['kelurahan' => 'CILANDAK BARAT', 'latitude' => -6.292053, 'longitude' => 106.798408, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CIPETE SELATAN', 'latitude' => -6.271645, 'longitude' => 106.803089, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'GANDARIA SELATAN', 'latitude' => -6.270608, 'longitude' => 106.795715, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CIGANJUR', 'latitude' => -6.337966, 'longitude' => 106.808988, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CIPEDAK', 'latitude' => -6.356180, 'longitude' => 106.800140, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'LENTENG AGUNG', 'latitude' => -6.325503, 'longitude' => 106.834110, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'TANJUNG BARAT', 'latitude' => -6.308036, 'longitude' => 106.838877, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CIPETE UTARA', 'latitude' => -6.259663, 'longitude' => 106.808083, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'GANDARIA UTARA', 'latitude' => -6.258018, 'longitude' => 106.789816, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'MELAWAI', 'latitude' => -6.244852, 'longitude' => 106.801614, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PETOGOGAN', 'latitude' => -6.242007, 'longitude' => 106.810463, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PULO', 'latitude' => -6.255172, 'longitude' => 106.798665, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CIPULIR', 'latitude' => -6.236820, 'longitude' => 106.773595, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'GROGOL SELATAN', 'latitude' => -6.230043, 'longitude' => 106.779881, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'GROGOL UTARA', 'latitude' => -6.215995, 'longitude' => 106.785392, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KEBAYORAN LAMA UTARA', 'latitude' => -6.245621, 'longitude' => 106.778019, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'BANGKA', 'latitude' => -6.260838, 'longitude' => 106.820787, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'DUREN TIGA', 'latitude' => -6.255340, 'longitude' => 106.832587, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KALIBATA', 'latitude' => -6.264141, 'longitude' => 106.837012, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PANCORAN', 'latitude' => -6.252300, 'longitude' => 106.847338, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CILANDAK TIMUR', 'latitude' => -6.279168, 'longitude' => 106.815297, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'JATI PADANG', 'latitude' => -6.286018, 'longitude' => 106.832587, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PEJATEN TIMUR', 'latitude' => -6.270095, 'longitude' => 106.850288, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'BINTARO', 'latitude' => -6.267882, 'longitude' => 106.761798, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PETUKANGAN SELATAN', 'latitude' => -6.242508, 'longitude' => 106.755900, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PETUKANGAN UTARA', 'latitude' => -6.227364, 'longitude' => 106.750002, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'ULUJAMI', 'latitude' => -6.240990, 'longitude' => 106.763273, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KARET KUNINGAN', 'latitude' => -6.219761, 'longitude' => 106.826687, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KARET SEMANGGI', 'latitude' => -6.221374, 'longitude' => 106.816363, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KUNINGAN TIMUR', 'latitude' => -6.229979, 'longitude' => 106.826687, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],

            ]], 
            ['name' => 'Jakarta Timur', 
            'latitude' => -6.225014, 
            'longitude' => 106.900447, 
            'flood_count' => 21, 
            'city_details' => [
                ['kelurahan' => 'BIDARA CINA', 'latitude' => -6.23471, 'longitude' => 106.86651, 'indeksBanjir' => 2.4, 'kategori' => 'Tinggi'],
                ['kelurahan' => 'KAMPUNG MELAYU', 'latitude' => -6.21850, 'longitude' => 106.86132, 'indeksBanjir' => 2.2, 'kategori' => 'Tinggi'],
                ['kelurahan' => 'JATINEGARA KAUM', 'latitude' => -6.19978, 'longitude' => 106.90110, 'indeksBanjir' => 1.6, 'kategori' => 'Sedang'],
                ['kelurahan' => 'CAKUNG BARAT', 'latitude' => -6.175457, 'longitude' => 106.932909, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CAKUNG TIMUR', 'latitude' => -6.177334, 'longitude' => 106.953569, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'JATINEGARA', 'latitude' => -6.230702, 'longitude' => 106.882743, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PULO GEBANG', 'latitude' => -6.207955, 'longitude' => 106.953569, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'BAMBU APUS', 'latitude' => -6.309249, 'longitude' => 106.903398, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CIBUBUR', 'latitude' => -6.356087, 'longitude' => 106.879792, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CIRACAS', 'latitude' => -6.323116, 'longitude' => 106.870940, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'RAMBUTAN', 'latitude' => -6.305112, 'longitude' => 106.873891, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'DUREN SAWIT', 'latitude' => -6.232191, 'longitude' => 106.915202, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PONDOK BAMBU', 'latitude' => -6.232579, 'longitude' => 106.903398, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'BALE KAMBANG', 'latitude' => -6.278394, 'longitude' => 106.849617, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CAWANG', 'latitude' => -6.241976, 'longitude' => 106.858621, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'DUKUH', 'latitude' => -6.296016, 'longitude' => 106.878317, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KRAMAT JATI', 'latitude' => -6.282586, 'longitude' => 106.859139, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CIPINANG MELAYU', 'latitude' => -6.252820, 'longitude' => 106.909300, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PINANG RANTI', 'latitude' => -6.290707, 'longitude' => 106.884218, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'CIJANTUNG', 'latitude' => -6.318611, 'longitude' => 106.864543, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PISANGAN TIMUR', 'latitude' => -6.207814, 'longitude' => 106.879792, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah']

            ]],
            ['name' => 'Jakarta Pusat',
            'latitude' => -6.186486, 
            'longitude' => 106.834091, 
            'flood_count' => 6, 
            'city_details' => [ 
                ['kelurahan' => 'CEMPAKA BARU', 'latitude' => -6.157916, 'longitude' => 106.844387, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'GUNUNG SAHARI', 'latitude' => -6.168778, 'longitude' => 106.863564, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'KEBON SIRIH', 'latitude' => -6.185143, 'longitude' => 106.831112, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'MANGGA DUA SELATAN', 'latitude' => -6.141856, 'longitude' => 106.828162, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'SENEN', 'latitude' => -6.193456, 'longitude' => 106.850288, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah'],
                ['kelurahan' => 'PETAMBURAN', 'latitude' => -6.192006, 'longitude' => 106.809018, 'indeksBanjir' => 1.4, 'kategori' => 'Rendah']
            ]], 
        ];

        foreach ($locations as $location) {
            $floodLocation = FloodLocation::create([
                'name' => $location['name'],
                'latitude' => $location['latitude'],
                'longitude' => $location['longitude'],
                'flood_count' => $location['flood_count'],
            ]);

            // Insert the related city details
            foreach ($location['city_details'] as $cityDetail) {
                CityDetail::create([
                    'flood_location_id' => $floodLocation->id,  // Foreign key reference
                    'kelurahan' => $cityDetail['kelurahan'],
                    'latitude' => $cityDetail['latitude'],
                    'longitude' => $cityDetail['longitude'],
                    'indeksBanjir' => $cityDetail['indeksBanjir'],
                    'kategori' => $cityDetail['kategori'],
                ]);
            }
        }
    }
}