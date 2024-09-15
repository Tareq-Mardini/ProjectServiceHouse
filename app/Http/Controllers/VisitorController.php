<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class VisitorController extends Controller
{
    public function view() {
        return view('visitor.visitor');
    }

    public function ViewSections () {
    $data = Section::all();
    return view('visitor.Sections', compact('data') );
}
}





