<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Supplier;
use App\Models\Work;

class SupplierPortfolioController extends Controller
{
    public function Create()
    {
        return view('Supplier.Home.portfolio.Create');
    }
    //===================================================================================
    public function store(Request $request)
    {
        $request->validate(
            [
                'about_me' => 'required|string|max:500',
                'language' => 'nullable|string|max:100',
                'skills_title.*' => 'nullable|required_with:skills_description.*|string|max:255',
                'skills_description.*' => 'nullable|required_with:skills_title.*|string|max:500',
                'experiences_date.*' => 'nullable|required_with:experiences_description.*|date',
                'experiences_description.*' => 'nullable|required_with:experiences_date.*|string|max:500',
                'educations_date.*' => 'nullable|required_with:educations_description.*|date',
                'educations_description.*' => 'nullable|required_with:educations_date.*|string|max:500',
                'galleries_title.*' => 'nullable|required_with:galleries_platform.*,galleries_link.*|string|max:255',
                'galleries_platform.*' => 'nullable|required_with:galleries_title.*,galleries_link.*|string|max:100',
                'galleries_link.*' => 'nullable|required_with:galleries_title.*,galleries_platform.*|url',
                'galleries_thumbnail.*' => 'nullable|required_with:galleries_title.*,galleries_platform.*,galleries_link.*|image|max:2048',
            ],
            [
                'about_me.required' => 'The "About Me" field is required.',
                'about_me.max' => 'The "About Me" field must not exceed 500 characters.',
                'language.max' => 'The language field must not exceed 100 characters.',
                'skills_title.*.required_with' => 'The skill title is required when the description is provided.',
                'skills_title.*.max' => 'The skill title must not exceed 255 characters.',
                'skills_description.*.required_with' => 'The skill description is required when the title is provided.',
                'skills_description.*.max' => 'The skill description must not exceed 500 characters.',
                'experiences_date.*.required_with' => 'The experience date is required when the description is provided.',
                'experiences_date.*.date' => 'The experience date must be a valid date.',
                'experiences_description.*.required_with' => 'The experience description is required when the date is provided.',
                'experiences_description.*.max' => 'The experience description must not exceed 500 characters.',
                'educations_date.*.required_with' => 'The education date is required when the description is provided.',
                'educations_date.*.date' => 'The education date must be a valid date.',
                'educations_description.*.required_with' => 'The education description is required when the date is provided.',
                'educations_description.*.max' => 'The education description must not exceed 500 characters.',
                'galleries.*.title.required_with' => 'The gallery title is required when the platform or link is provided.',
                'galleries.*.title.max' => 'The gallery title must not exceed 255 characters.',
                'galleries.*.platform.required_with' => 'The platform is required when the gallery title or link is provided.',
                'galleries.*.platform.max' => 'The platform name must not exceed 100 characters.',
                'galleries.*.link.required_with' => 'The link is required when the gallery title or platform is provided.',
                'galleries.*.link.url' => 'The link must be a valid URL.',
                'galleries.*.thumbnail.required_with' => 'The thumbnail image is required when the gallery title, platform, and link are provided.',
                'galleries.*.thumbnail.image' => 'The thumbnail must be an image file.',
                'galleries.*.thumbnail.max' => 'The thumbnail image size must not exceed 2MB.',
            ]
        );

        $userId = session('supplier_user_id');
        $portfolio = Portfolio::create([
            'supplier_id' => $userId,
            'about_me' => $request->input('about_me'),
            'language' => $request->input('language'),
        ]);
        if ($request->has('skills_title') && count($request->input('skills_title')) > 0) {
            foreach ($request->input('skills_title') as $index => $title) {
                if ($title && $request->input('skills_description')[$index]) {
                    $portfolio->skills()->create([
                        'title' => $title,
                        'description' => $request->input('skills_description')[$index] ?? null,
                    ]);
                }
            }
        }

        if ($request->has('experiences_date') && count($request->input('experiences_date')) > 0) {
            foreach ($request->input('experiences_date') as $index => $date) {
                if ($date && $request->input('experiences_description')[$index]) {
                    $portfolio->experiences()->create([
                        'date' => $date,
                        'description' => $request->input('experiences_description')[$index],
                    ]);
                }
            }
        }

        if ($request->has('educations_date') && count($request->input('educations_date')) > 0) {
            foreach ($request->input('educations_date') as $index => $date) {
                if ($date && $request->input('educations_description')[$index]) {
                    $portfolio->educations()->create([
                        'date' => $date,
                        'description' => $request->input('educations_description')[$index],
                    ]);
                }
            }
        }

        if ($request->has('galleries') && count($request->input('galleries')) > 0) {
            foreach ($request->input('galleries') as $index => $gallery) {
                if ($gallery['title'] && $gallery['platform'] && $gallery['link']) {
                    $thumbnailPath = null;
                    if ($request->hasFile("galleries.$index.thumbnail") && $request->file("galleries.$index.thumbnail")->isValid()) {
                        $thumbnailPath = $request->file("galleries.$index.thumbnail")->store('images/works/multiple', 'public');
                    }
                    $portfolio->galleries()->create([
                        'title' => $gallery['title'],
                        'platform' => $gallery['platform'],
                        'link' => $gallery['link'],
                        'thumbnail' => $thumbnailPath,
                    ]);
                }
            }
        }
        session()->flash('Success_Create', 'Success Create Portfolio');  
        return redirect()->route('Supplier.View.Portfolio');
    }
    //===================================================================================
    public function editPortfolio()
    {
        $userId = session('supplier_user_id');
        $portfolio = Portfolio::with(['skills', 'educations', 'experiences', 'galleries'])
            ->where('supplier_id', $userId)
            ->first();
        if (!$portfolio) {
            return redirect()->back()->with('error', 'Portfolio not found');
        }
        return view('Supplier.Home.portfolio.Edit', compact('portfolio'));
    }
    //===================================================================================
    public function updatePortfolio(Request $request)
    {
        $validated = $request->validate([
            'about_me' => 'required|string|max:500',
            'language' => 'nullable|string|max:100',
            'skills_title.*' => 'nullable|required_with:skills_description.*|string|max:255',
            'skills_description.*' => 'nullable|required_with:skills_title.*|string|max:500',
            'experiences_date.*' => 'nullable|required_with:experiences_description.*|date',
            'experiences_description.*' => 'nullable|required_with:experiences_date.*|string|max:500',
            'educations_date.*' => 'nullable|required_with:educations_description.*|date',
            'educations_description.*' => 'nullable|required_with:educations_date.*|string|max:500',
            'galleries.*.title' => 'string',
            'galleries.*.platform' => 'string',
            'galleries.*.link' => 'url',
            'galleries.*.thumbnail' => 'image|nullable',
        ],);

        $userId = session('supplier_user_id');
        $portfolio = Portfolio::where('supplier_id', $userId)->first();
        if (!$portfolio) {
            return back()->with('error', 'Portfolio not found');
        }
        $portfolio->about_me = $validated['about_me'];
        $portfolio->language = $validated['language'];
        if (isset($validated['skills_title'])) {
            foreach ($validated['skills_title'] as $index => $skillTitle) {
                if (isset($portfolio->skills[$index])) {
                    $portfolio->skills[$index]->title = $skillTitle;
                    $portfolio->skills[$index]->description = $validated['skills_description'][$index];
                    $portfolio->skills[$index]->save();
                }
            }
        }

        if (isset($validated['educations_date'])) {
            foreach ($validated['educations_date'] as $index => $educationDate) {
                if (isset($portfolio->educations[$index])) {
                    $portfolio->educations[$index]->date = $educationDate;
                    $portfolio->educations[$index]->description = $validated['educations_description'][$index];
                    $portfolio->educations[$index]->save();
                }
            }
        }

        if (isset($validated['experiences_date'])) {
            foreach ($validated['experiences_date'] as $index => $experienceDate) {
                if (isset($portfolio->experiences[$index])) {
                    $portfolio->experiences[$index]->date = $experienceDate;
                    $portfolio->experiences[$index]->description = $validated['experiences_description'][$index];
                    $portfolio->experiences[$index]->save();
                }
            }
        }

        if (isset($validated['galleries'])) {
            foreach ($validated['galleries'] as $index => $gallery) {
                if (isset($portfolio->galleries[$index])) {
                    $portfolio->galleries[$index]->title = $gallery['title'];
                    $portfolio->galleries[$index]->platform = $gallery['platform'];
                    $portfolio->galleries[$index]->link = $gallery['link'];
                    if (isset($gallery['thumbnail'])) {
                        $portfolio->galleries[$index]->thumbnail = $gallery['thumbnail']->store('galleries');
                    }
                    $portfolio->galleries[$index]->save();
                }
            }
        }
        $portfolio->save();
        session()->flash('Success_Update', 'Success Update Portfolio'); 
        return redirect()->route('Supplier.View.Portfolio');
    }
    //===================================================================================
    public function view()
    {
        $userId = session('supplier_user_id');
        $works = Work::where('supplier_id', $userId)->get();
        $data = Supplier::select('name', 'image')->where('id', $userId)->first();
        $portfolio = Portfolio::with(['skills', 'educations', 'experiences', 'galleries'])
            ->where('supplier_id', $userId)
            ->first();
        if (!$portfolio) {
            return view('Supplier.Home.portfolio.MyPortfolioNull');
        }
        return view('Supplier.Home.portfolio.MyPortfolio', compact('portfolio','data','works'));
    }
    //=====================================================================================
    public function DeletePortfolio(){
        $userId = session('supplier_user_id');
        $portfolio = Portfolio::where('supplier_id', $userId)->first();
        $portfolio->delete();
        session()->flash('Success_Delete', 'Success Delete Portfolio'); 
        return redirect()->route('Supplier.View.Portfolio');
    }
}
