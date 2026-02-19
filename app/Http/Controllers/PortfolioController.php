<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile  = Profile::getProfile();
        $projects = Project::where('is_active', true)->orderBy('order')->get();
        $featured = Project::where('is_active', true)->where('featured', true)->get();

        return view('portfolio.index', compact('profile', 'projects', 'featured'));
    }

    public function project($slug)
    {
        $project = Project::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $profile = Profile::getProfile();
        $related = Project::where('is_active', true)
            ->where('id', '!=', $project->id)
            ->where('category', $project->category)
            ->limit(2)->get();

        return view('portfolio.project', compact('project', 'profile', 'related'));
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Pesan berhasil dikirim! Saya akan membalas segera. 🚀');
    }
}
