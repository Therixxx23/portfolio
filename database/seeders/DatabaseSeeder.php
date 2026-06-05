<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Game;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Experience::create([
            'company' => 'Game House Genply',
            'role' => 'Game Developer',
            'period' => '2020 – 2021',
            'description' => 'Pengembangan game menggunakan Unity, desain mekanik gameplay, dan optimasi performa.',
            'sort_order' => 1,
        ]);

        Experience::create([
            'company' => 'Bandeng Presto Cianjur',
            'role' => 'Graphic Designer (Instagram)',
            'period' => '2021 – 2022',
            'description' => 'Mengelola konten visual Instagram brand, membuat desain feed, stories, dan promosi menggunakan Canva.',
            'sort_order' => 2,
        ]);

        Education::create([
            'institution' => 'SMK Negeri 1 Cianjur',
            'major' => 'Rekayasa Perangkat Lunak',
            'period' => '2019 – 2022',
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Personal Portfolio',
            'description' => 'Portfolio website interaktif dengan Liquid Glass design system, dibangun dengan Laravel + Tailwind CSS.',
            'tech_stack' => ['Laravel', 'Tailwind CSS', 'JavaScript'],
            'category' => 'web',
            'demo_url' => '#',
            'repo_url' => '#',
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Unity Game Project',
            'description' => 'Game 2D/3D dikembangkan dengan Unity Engine, mencakup mekanik gameplay dan optimasi performa.',
            'tech_stack' => ['Unity', 'C#'],
            'category' => 'unity',
            'demo_url' => '/play',
            'repo_url' => '#',
            'sort_order' => 2,
        ]);

        Game::create([
            'title' => 'Sample Unity Game',
            'slug' => 'sample-unity-game',
            'description' => 'A Unity WebGL game demo.',
            'iframe_url' => 'https://itch.io/embed/1234567',
            'category' => 'unity',
            'sort_order' => 1,
        ]);
    }
}
