<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Supplier;
use App\Models\Work;
use App\Models\services;

class SupplierPortfolioController extends Controller
{
    public function Create()
    {
        return view('Supplier.Home.portfolio.Create');
    }
    //===================================================================================
    public function store(Request $request)
    {
        $request->validate([
            'about_me' => 'required|string|max:500',
            'language' => 'nullable|string|max:100',

            'skills_title.*' => 'nullable|required_with:skills_description.*|string|max:255',
            'skills_description.*' => 'nullable|required_with:skills_title.*|string|max:500',

            'experiences_date.*' => [
                'nullable',
                'required_with:experiences_description.*',
                'date',
                'before_or_equal:' . now()->subYears(18)->toDateString(),
                'after_or_equal:' . now()->subYears(100)->toDateString(),
            ],
            'experiences_description.*' => 'nullable|required_with:experiences_date.*|string|max:500',

            'educations_date.*' => [
                'nullable',
                'required_with:educations_description.*',
                'date',
                'before_or_equal:' . now()->subYears(18)->toDateString(),
                'after_or_equal:' . now()->subYears(100)->toDateString(),
            ],
            'educations_description.*' => 'nullable|required_with:educations_date.*|string|max:500',

            'galleries_title.*' => 'nullable|required_with:galleries_platform.*,galleries_link.*|string|max:255',
            'galleries_platform.*' => 'nullable|required_with:galleries_title.*,galleries_link.*|string|max:100',
            'galleries_link.*' => 'nullable|required_with:galleries_title.*,galleries_platform.*|url',
            'galleries_thumbnail.*' => 'nullable|required_with:galleries_title.*,galleries_platform.*,galleries_link.*|image|max:2048',
        ]);
        $userId = session('supplier_user_id');
        $portfolio = Portfolio::create([
            'supplier_id' => $userId,
            'about_me' => $request->input('about_me'),
            'language' => $request->input('language'),
        ]);

        if ($request->has('skills_title')) {
            foreach ($request->input('skills_title') as $index => $title) {
                if ($title && $request->input('skills_description')[$index]) {
                    $portfolio->skills()->create([
                        'title' => $title,
                        'description' => $request->input('skills_description')[$index],
                    ]);
                }
            }
        }

        if ($request->has('experiences_date')) {
            foreach ($request->input('experiences_date') as $index => $date) {
                if ($date && $request->input('experiences_description')[$index]) {
                    $portfolio->experiences()->create([
                        'date' => $date,
                        'description' => $request->input('experiences_description')[$index],
                    ]);
                }
            }
        }

        if ($request->has('educations_date')) {
            foreach ($request->input('educations_date') as $index => $date) {
                if ($date && $request->input('educations_description')[$index]) {
                    $portfolio->educations()->create([
                        'date' => $date,
                        'description' => $request->input('educations_description')[$index],
                    ]);
                }
            }
        }

        if ($request->has('galleries')) {
            foreach ($request->input('galleries') as $index => $gallery) {
                if (!empty($gallery['title']) && !empty($gallery['platform']) && !empty($gallery['link'])) {
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

        $combinedText = $portfolio->about_me ?? '';

        foreach ($portfolio->skills as $skill) {
            $combinedText .= ' ' . ($skill->title ?? '') . ' ' . ($skill->description ?? '');
        }

        foreach ($portfolio->experiences as $exp) {
            $combinedText .= ' ' . ($exp->description ?? '');
        }

        foreach ($portfolio->educations as $edu) {
            $combinedText .= ' ' . ($edu->description ?? '');
        }

        foreach ($portfolio->galleries as $gallery) {
            $combinedText .= ' ' . ($gallery->title ?? '');
        }
        $services = services::get();

        $matchedServices = [];

        foreach ($services as $service) {
            $matchCount = 0;
            $totalCount = 0;
            $serviceText = strtolower($service->name . ' ' . $service->description);

            $words = explode(' ', strtolower($combinedText));
            $uniqueWords = array_unique(array_filter($words));

            $totalCount = count($uniqueWords);

            foreach ($uniqueWords as $word) {
                if (strlen($word) > 2 && str_contains($serviceText, $word)) {
                    $matchCount++;
                }
            }

            if ($matchCount > 0) {
                $percent = ($matchCount / $totalCount) * 100;
                $matchedServices[] = [
                    'service' => $service,
                    'match_percent' => round($percent, 1),
                ];
            }
        }

        usort($matchedServices, function ($a, $b) {
            return $b['match_percent'] <=> $a['match_percent'];
        });

        session()->put('suggested_services', array_slice($matchedServices, 0, 10));

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

            'experiences_date.*' => [
                'nullable',
                'required_with:experiences_description.*',
                'date',
                'before_or_equal:' . now()->subYears(18)->toDateString(),
                'after_or_equal:' . now()->subYears(100)->toDateString(),
            ],
            'experiences_description.*' => 'nullable|required_with:experiences_date.*|string|max:500',

            'educations_date.*' => [
                'nullable',
                'required_with:educations_description.*',
                'date',
                'before_or_equal:' . now()->subYears(18)->toDateString(),
                'after_or_equal:' . now()->subYears(100)->toDateString(),
            ],
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

        $combinedText = $portfolio->about_me ?? '';

        foreach ($portfolio->skills as $skill) {
            $combinedText .= ' ' . ($skill->title ?? '') . ' ' . ($skill->description ?? '');
        }

        foreach ($portfolio->experiences as $exp) {
            $combinedText .= ' ' . ($exp->description ?? '');
        }

        foreach ($portfolio->educations as $edu) {
            $combinedText .= ' ' . ($edu->description ?? '');
        }

        foreach ($portfolio->galleries as $gallery) {
            $combinedText .= ' ' . ($gallery->title ?? '');
        }
        $services = services::get();

        $matchedServices = [];

        foreach ($services as $service) {
            $matchCount = 0;
            $totalCount = 0;
            $serviceText = strtolower($service->name . ' ' . $service->description);

            $words = explode(' ', strtolower($combinedText));
            $uniqueWords = array_unique(array_filter($words));

            $totalCount = count($uniqueWords);

            foreach ($uniqueWords as $word) {
                if (strlen($word) > 2 && str_contains($serviceText, $word)) {
                    $matchCount++;
                }
            }

            if ($matchCount >= 2) {
                $percent = ($matchCount / $totalCount) * 100;
                $matchedServices[] = [
                    'service' => $service,
                    'match_percent' => round($percent, 1),
                ];
            }
        }

        usort($matchedServices, function ($a, $b) {
            return $b['match_percent'] <=> $a['match_percent'];
        });

        session()->put('suggested_services', array_slice($matchedServices, 0, 10));
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
        return view('Supplier.Home.portfolio.MyPortfolio', compact('portfolio', 'data', 'works'));
    }
    //=====================================================================================
    public function DeletePortfolio()
    {
        $userId = session('supplier_user_id');
        $portfolio = Portfolio::where('supplier_id', $userId)->first();
        $portfolio->delete();
        session()->flash('Success_Delete', 'Success Delete Portfolio');
        return redirect()->route('Supplier.View.Portfolio');
    }
}
