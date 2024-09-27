<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function View() {
        return view('Supplier.Home.Home');
    }

    public function ViewDashboard() {
        return view('Supplier.Home.Dashboard');
    }
}
