<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AdminCrudController extends Controller
{
    // ──────────────────────────────────────────────
    // Experience CRUD
    // ──────────────────────────────────────────────

    public function experiences()
    {
        $experiences = Experience::orderBy('sort_order')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function createExperience()
    {
        return view('admin.experiences.form');
    }

    public function editExperience(Experience $experience)
    {
        return view('admin.experiences.form', compact('experience'));
    }

    public function saveExperience(Request $request, ?Experience $experience = null)
    {
        $data = $request->validate([
            'company'     => 'required',
            'role'        => 'required',
            'period'      => 'required',
            'description' => 'nullable',
        ]);

        if ($experience) {
            $experience->update($data);
        } else {
            Experience::create($data);
        }

        return redirect()->route('admin.experiences')->with('success', 'Experience saved successfully.');
    }

    public function deleteExperience(Experience $experience)
    {
        $experience->delete();
        return redirect()->back()->with('success', 'Experience deleted successfully.');
    }

    // ──────────────────────────────────────────────
    // Education CRUD
    // ──────────────────────────────────────────────

    public function educations()
    {
        $educations = Education::orderBy('sort_order')->get();
        return view('admin.educations.index', compact('educations'));
    }

    public function createEducation()
    {
        return view('admin.educations.form');
    }

    public function editEducation(Education $education)
    {
        return view('admin.educations.form', compact('education'));
    }

    public function saveEducation(Request $request, ?Education $education = null)
    {
        $data = $request->validate([
            'institution' => 'required',
            'major'       => 'required',
            'period'      => 'required',
        ]);

        if ($education) {
            $education->update($data);
        } else {
            Education::create($data);
        }

        return redirect()->route('admin.educations')->with('success', 'Education saved successfully.');
    }

    public function deleteEducation(Education $education)
    {
        $education->delete();
        return redirect()->back()->with('success', 'Education deleted successfully.');
    }

    // ──────────────────────────────────────────────
    // Project CRUD
    // ──────────────────────────────────────────────

    public function projects()
    {
        $projects = Project::orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function createProject()
    {
        return view('admin.projects.form');
    }

    public function editProject(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function saveProject(Request $request, ?Project $project = null)
    {
        $data = $request->validate([
            'title'       => 'required',
            'description' => 'nullable',
            'category'    => 'required|in:unity,web',
            'tech_stack'  => 'nullable|string',
            'demo_url'    => 'nullable|url',
            'repo_url'    => 'nullable|url',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        if (isset($data['tech_stack']) && is_string($data['tech_stack'])) {
            $data['tech_stack'] = array_map('trim', explode(',', $data['tech_stack']));
        }

        if ($project) {
            $project->update($data);
        } else {
            Project::create($data);
        }

        return redirect()->route('admin.projects')->with('success', 'Project saved successfully.');
    }

    public function deleteProject(Project $project)
    {
        if ($project->thumbnail && Storage::disk('public')->exists($project->thumbnail)) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        $project->delete();
        return redirect()->back()->with('success', 'Project deleted successfully.');
    }

    // ──────────────────────────────────────────────
    // Game CRUD
    // ──────────────────────────────────────────────

    public function games()
    {
        $games = Game::orderBy('sort_order')->get();
        return view('admin.games.index', compact('games'));
    }

    public function createGame()
    {
        return view('admin.games.form');
    }

    public function editGame(Game $game)
    {
        return view('admin.games.form', compact('game'));
    }

    public function saveGame(Request $request, ?Game $game = null)
    {
        $rules = [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:50',
            'status'      => 'nullable|in:published,draft',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'iframe_url'  => 'nullable|url|max:1000',
        ];

        $validated = $request->validate($rules);

        $slug = $request->slug ?? ($game?->slug ?? Str::slug($validated['title']));

        if (empty($slug) || !preg_match('/^[a-z0-9\-]+$/', $slug)) {
            return back()->withErrors(['slug' => 'Invalid slug format. Use only lowercase letters, numbers, and hyphens.'])->withInput();
        }

        $existingSlug = Game::where('slug', $slug)->where('id', '!=', $game?->id ?? 0)->first();
        if ($existingSlug) {
            return back()->withErrors(['slug' => 'A game with this slug already exists.'])->withInput();
        }

        $data = [
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category'    => $validated['category'],
            'slug'        => $slug,
            'iframe_url'  => $validated['iframe_url'] ?? null,
            'status'      => $validated['status'] ?? $game?->status ?? 'published',
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('games', 'public');
        }

        if ($game) {
            $game->update($data);
        } else {
            Game::create($data);
        }

        return redirect()->route('admin.games')->with('success', 'Game saved successfully.');
    }

    public function deleteGame(Game $game)
    {
        try {
            if ($game->thumbnail && Storage::disk('public')->exists($game->thumbnail)) {
                Storage::disk('public')->delete($game->thumbnail);
            }

            $game->delete();
            return redirect()->back()->with('success', 'Game deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Game delete failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Failed to delete game: ' . $e->getMessage()]);
        }
    }
}
