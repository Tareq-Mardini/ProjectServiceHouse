<?php

namespace App\Http\Controllers;
use App\Models\Section;
use App\Models\services;
use App\Models\Service;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function View() {
        return view('Supplier.Home.Home');
    }

    public function ViewDashboard() {
        return view('Supplier.Home.Dashboard');
    }

    public function ShowSections(){
        $data = Section::all();
        return view('Supplier.Home.Sections', compact('data') );
    }
    
    public function ViewServices(){
        $data = services::all();
        return view('Supplier.Home.Services',compact('data'));
    }

    
}
