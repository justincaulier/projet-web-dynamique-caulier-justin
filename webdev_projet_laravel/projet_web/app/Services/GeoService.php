<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeoService
{
    public function getGpsCoordinatesByAddress(array $args): array
    {
        $baseUrl = config('geo.nominatim_base_url');

        $query = $args['street'].' '.$args['number'].' '.$args['city'].' '.$args['country'];

        $response = Http::get($baseUrl, [
            'q' => $query,
            'format' => 'json',
            'limit' => 1
        ]);

        if ($response->successful() && count($response->json()) > 0) {

            $gps = $response->json()[0];

            return [
                'lat' => $gps['lat'],
                'lon' => $gps['lon']
            ];
        }

        return [];
    }
}
