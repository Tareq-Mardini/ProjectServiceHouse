<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'work_id' => 'required|exists:works,id',
            'quality' => 'required|integer|min:1|max:5',
            'communication' => 'required|integer|min:1|max:5',
            'timeliness' => 'required|integer|min:1|max:5',
            'satisfaction' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:2000',
        ]);
        $userId = session('Client_user_id');
        $review = Review::where('client_id', $userId)
            ->where('work_id', $request->work_id)
            ->first();
        if ($review) {
            $review->update($validated);
            session()->flash('Update_Review', 'Success Update Review');
            return redirect()->back();
        } else {
            $validated['client_id'] = $userId;
            Review::create($validated);
            session()->flash('Create_Review', 'Success Create Review');
            return redirect()->back();
        }
    }
}
