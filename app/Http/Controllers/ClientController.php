<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function View() {
        return view('Client.Home.Home');
    }
}
