<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function dashboard()
    {
        $totalProjects  = Project::count();
        $activeProjects = Project::where('is_active', true)->count();
        $totalContacts  = Contact::count();
        $unreadContacts = Contact::where('is_read', false)->count();
        $latestContacts = Contact::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalProjects', 'activeProjects',
            'totalContacts', 'unreadContacts', 'latestContacts'
        ));
    }

    public function index()
    {
        $projects = Project::orderBy('order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:200',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'category'         => 'required|string|max:100',
            'url_live'         => 'nullable|url',
            'url_github'       => 'nullable|url',
            'order'            => 'nullable|integer|min:0',
            'image'            => 'nullable|image|max:10240',
        ]);

        $data['featured']   = $request->has('featured') ? 1 : 0;
        $data['is_active']  = $request->has('is_active') ? 1 : 0;
        $data['order']      = $request->input('order', 0);
        $data['slug']       = Str::slug($request->title);
        $data['tech_stack'] = array_map('trim', explode(',', $request->tech_stack_input ?? ''));

        if ($request->hasFile('image')) {
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);
            $result = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath());
            $data['image'] = $result['secure_url'];
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil ditambahkan! 🎉');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:200',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'category'         => 'required|string|max:100',
            'url_live'         => 'nullable|url',
            'url_github'       => 'nullable|url',
            'order'            => 'nullable|integer|min:0',
            'image'            => 'nullable|image|max:10240',
        ]);

        $data['featured']   = $request->has('featured') ? 1 : 0;
        $data['is_active']  = $request->has('is_active') ? 1 : 0;
        $data['order']      = $request->input('order', 0);
        $data['tech_stack'] = array_map('trim', explode(',', $request->tech_stack_input ?? ''));

        if ($request->hasFile('image')) {
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);
            $result = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath());
            $data['image'] = $result['secure_url'];
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil diperbarui! ✅');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back()->with('success', 'Project berhasil dihapus.');
    }

    public function contacts()
    {
        $contacts = Contact::latest()->get();
        Contact::where('is_read', false)->update(['is_read' => true]);
        return view('admin.contacts', compact('contacts'));
    }

    public function editProfile()
    {
        $profile = Profile::getProfile();
        return view('admin.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $profile = Profile::getProfile();
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'title'     => 'required|string|max:100',
            'tagline'   => 'required|string|max:200',
            'about'     => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'nullable|string',
            'location'  => 'nullable|string',
            'github'    => 'nullable|url',
            'linkedin'  => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        if ($request->skills_input) {
            $skills = [];
            foreach (explode(',', $request->skills_input) as $item) {
                $parts = explode(':', trim($item));
                if (count($parts) >= 2) {
                    $skills[] = ['name' => trim($parts[0]), 'level' => (int)trim($parts[1]), 'icon' => '⚡'];
                }
            }
            $data['skills'] = json_encode($skills);
        }

        $profile->update($data);

        return back()->with('success', 'Profil berhasil diperbarui! 🎉');
    }
}
