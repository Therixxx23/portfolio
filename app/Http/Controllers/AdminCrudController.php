<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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
        $slug = $request->slug
            ?? ($game?->slug ?? Str::slug($request->title));

        $rules = [
            'title'       => 'required',
            'slug'        => 'nullable|unique:games,slug,' . ($game?->id ?? 'NULL') . ',id',
            'description' => 'nullable',
            'category'    => 'required',
            'status'      => 'nullable|in:published,draft',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'build_zip'   => $game ? 'nullable|file|mimes:zip|max:51200' : 'nullable|file|mimes:zip|max:51200',
        ];

        $data = $request->validate($rules);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('games', 'public');
        }

        $data['slug'] = $slug;
        $data['path'] = '/games/' . $slug . '/index.html';

        if (!isset($data['status'])) {
            $data['status'] = $game?->status ?? 'published';
        }

        if ($game) {
            $game->update($data);
        } else {
            $game = Game::create($data);
        }

        if ($request->hasFile('build_zip')) {
            $zip = $request->file('build_zip');
            $extractPath = public_path('games/' . $game->slug);
            $zipPath = $zip->getPathname();

            if (!is_dir($extractPath)) {
                mkdir($extractPath, 0755, true);
            }

            $this->extractZip($zipPath, $extractPath);
        }

        return redirect()->route('admin.games')->with('success', 'Game saved successfully.');
    }

    public function deleteGame(Game $game)
    {
        if ($game->thumbnail && Storage::disk('public')->exists($game->thumbnail)) {
            Storage::disk('public')->delete($game->thumbnail);
        }

        $gamePath = public_path('games/' . $game->slug);
        if (is_dir($gamePath)) {
            $this->rmdirRecursive($gamePath);
        }

        $game->delete();
        return redirect()->back()->with('success', 'Game deleted successfully.');
    }

    private function extractZip(string $zipPath, string $destination): void
    {
        $zipPath = str_replace('/', '\\', $zipPath);
        $destination = str_replace('/', '\\', $destination);
        $command = "powershell -Command \"Expand-Archive -Path '$zipPath' -DestinationPath '$destination' -Force\"";
        exec($command . ' 2>&1', $output, $exitCode);
        if ($exitCode !== 0) {
            throw new \RuntimeException('ZIP extraction failed: ' . implode("\n", $output));
        }
    }

    private function rmdirRecursive(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }
        $items = array_diff(scandir($dir), ['.', '..']);
        foreach ($items as $item) {
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            is_dir($path) ? $this->rmdirRecursive($path) : unlink($path);
        }
        rmdir($dir);
    }
}
