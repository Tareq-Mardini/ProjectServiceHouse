<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class RecommendationController extends Controller
{
    public function getRecommendations($clientId){
        $url = env('RECOMMENDATION_API_URL', 'http://127.0.0.1:5000') . "/recommend/{$clientId}";
        try {
        $response = Http::get($url);
        
        if ($response->failed()) {
            return back()->with('error', 'Failed to fetch recommendations.');
        }

        // التحقق انو عم تنعامل مع مصفوفة
        $recommendations = $response->json('recommendations', []); 
        
        if (!is_array($recommendations)) {
            // التحويل لمصفوفة بحال كان في قيمة وحدة
            $recommendations = [$recommendations]; 
        }

        return view('Client.Home.recommend', ['recommendations' => $recommendations, 'clientId' => $clientId]);

        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to recommendation service');
        }
    }
}
