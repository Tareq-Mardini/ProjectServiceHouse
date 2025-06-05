<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\services;
use App\Models\Work;
use App\Models\WorkImage;
use App\Models\Supplier;
use App\Models\Portfolio;
use App\Models\WorkExtra;

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

  public function ViewWorks($id)
  {
      $data = Work::where('service_id', $id)->get();
      return view('visitor.Works', compact('data'));
  }

  public function ViewinfoWorks($id)
  {
      $works = Work::where('id', $id)->first();
      $image = WorkImage::where('work_id', $id)->get('image_path');
      $offers = WorkExtra::where('work_id', $id)->get();
      return view('visitor.WorkInfo', compact('works', 'image','offers'));
  }

  public function ViewPortfolio($id)
  {
      $works = Work::where('supplier_id', $id)->get();
      $data = Supplier::select('name', 'image')->where('id', $id)->first();
      $portfolio = Portfolio::with(['skills', 'educations', 'experiences', 'galleries'])
          ->where('supplier_id', $id)
          ->first();
      if (!$portfolio) {
          return view('visitor.NullPortfolio');
      }
      return view('visitor.portfolio', compact('portfolio','data','works'));
  }

}
