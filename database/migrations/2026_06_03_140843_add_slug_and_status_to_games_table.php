<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
            $table->string('status')->default('published')->after('path');
        });

        DB::table('games')->whereNull('slug')->orderBy('id')->each(function ($game) {
            DB::table('games')
                ->where('id', $game->id)
                ->update(['slug' => Str::slug($game->title) . '-' . $game->id]);
        });

        Schema::table('games', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn(['slug', 'status']);
        });
    }
};
