<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\services;

class VisitorController extends Controller {
  public function view() {
    return view('visitor.visitor');
  }

  public function ViewSections() {
    $data = Section::all();
    return view('visitor.Sections', compact('data'));
  }

  public function ViewServices($id) {
    $data = services::where('section_id', $id)->get();
    return view('visitor.Services', compact('data'));
  }

}
