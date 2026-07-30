<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class MapTileController extends Controller
{
    public function proxy(Request $request, int $z, int $x, int $y): Response
    {
        $apiKey = (string) config('services.stadia_key');

        if ($apiKey === '') {
            $url = "https://tile.openstreetmap.org/{$z}/{$x}/{$y}.png";
        } else {
            $url = "https://tiles.stadiamaps.com/tiles/alidade_smooth/{$z}/{$x}/{$y}.png?api_key={$apiKey}";
        }

        $resp = Http::withHeaders([
            'User-Agent' => config('app.name') . '/tile-proxy',
        ])->timeout(10)->get($url);

        if (!$resp->successful()) {
            return response('', $resp->status());
        }

        return response($resp->body(), 200, [
            'Content-Type' => $resp->header('Content-Type', 'image/png'),
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
