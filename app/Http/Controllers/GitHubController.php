<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GitHubController extends Controller
{
    protected string $username;
    protected array $headers;

    public function __construct()
    {
        $this->username = env('GITHUB_USERNAME', '');
        $token = env('GITHUB_TOKEN', '');

        $this->headers = [
            'Accept' => 'application/vnd.github.v3+json',
            'User-Agent' => 'Laravel-Portfolio',
        ];

        if ($token) {
            $this->headers['Authorization'] = 'Bearer ' . $token;
        }
    }

    protected function client(): \Illuminate\Http\Client\PendingRequest
    {
        $http = Http::withHeaders($this->headers);

        if (app()->environment('local')) {
            $http->withoutVerifying();
        }

        return $http;
    }

    public function index()
    {
        $user = $this->fetchUser();
        $repos = $this->fetchRepos();
        $events = $this->fetchEvents();
        $stats = $this->calculateStats($repos, $events);
        $contributions = $this->fetchContributions();

        return view('github', [
            'user' => $user,
            'repos' => $repos,
            'events' => $events,
            'stats' => $stats,
            'contributions' => $contributions,
            'error' => null,
        ]);
    }

    protected function fetchUser(): ?array
    {
        if (!$this->username) return null;

        $response = $this->client()
            ->get("https://api.github.com/users/{$this->username}");

        if ($response->failed()) return null;

        return $response->json();
    }

    protected function fetchRepos(): array
    {
        if (!$this->username) return [];

        $response = $this->client()
            ->get("https://api.github.com/users/{$this->username}/repos", [
                'per_page' => 100,
                'sort' => 'updated',
                'type' => 'owner',
            ]);

        if ($response->failed()) return [];

        return $response->json();
    }

    protected function fetchContributions(): ?array
    {
        if (!$this->username) return null;

        $token = env('GITHUB_TOKEN', '');
        if (!$token) return null;

        $query = [
            'query' => 'query { user(login: "' . $this->username . '") { contributionsCollection { contributionCalendar { totalContributions weeks { contributionDays { contributionCount date color } } } } } }',
        ];

        $response = $this->client()
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post('https://api.github.com/graphql', $query);

        if ($response->failed()) return null;

        $data = $response->json();

        return $data['data']['user']['contributionsCollection']['contributionCalendar'] ?? null;
    }

    protected function fetchEvents(): array
    {
        if (!$this->username) return [];

        $response = $this->client()
            ->get("https://api.github.com/users/{$this->username}/events", [
                'per_page' => 30,
            ]);

        if ($response->failed()) return [];

        return $response->json();
    }

    protected function calculateStats(array $repos, array $events): array
    {
        $totalStars = 0;
        $totalForks = 0;
        foreach ($repos as $repo) {
            $totalStars += $repo['stargazers_count'] ?? 0;
            $totalForks += $repo['forks_count'] ?? 0;
        }

        $pushEvents = 0;
        $eventDates = [];
        $today = now();

        foreach ($events as $event) {
            if (($event['type'] ?? '') === 'PushEvent') {
                $pushEvents += count($event['payload']['commits'] ?? []);
            }
            $date = substr($event['created_at'] ?? '', 0, 10);
            if ($date) {
                $eventDates[] = $date;
            }
        }

        $streak = $this->calculateStreak($eventDates);

        return [
            'public_repos' => count($repos),
            'total_stars' => $totalStars,
            'total_forks' => $totalForks,
            'total_commits' => $pushEvents,
            'recent_events' => count($events),
            'streak' => $streak,
        ];
    }

    protected function calculateStreak(array $dates): int
    {
        if (empty($dates)) return 0;

        $uniqueDates = array_unique($dates);
        rsort($uniqueDates);

        $streak = 0;
        $checkDate = now()->format('Y-m-d');

        foreach ($uniqueDates as $date) {
            if ($date === $checkDate) {
                $streak++;
                $checkDate = now()->subDays($streak)->format('Y-m-d');
            } elseif ($date < $checkDate) {
                break;
            }
        }

        return $streak;
    }
}
