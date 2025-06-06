<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle($id)
    {
        $client = session('Client_user_id');

        $favorite = Favorite::where('client_id', $client)
            ->where('work_id', $id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'client_id' => $client,
                'work_id' => $id,
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    public function ViewFavorite(){
        $client = session('Client_user_id');
        $favorites = Favorite::where('client_id', $client)->pluck('work_id')->toArray();
        $data = Work::whereIn('id', $favorites)->get();
        return view('Client.Settings.MyFavorite.View', compact('data', 'favorites'));

    }   
}
