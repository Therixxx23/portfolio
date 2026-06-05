<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->json('image_gallery')->nullable()->after('thumbnail');
            $table->string('external_link')->nullable()->after('repo_url');
            $table->string('link_label')->nullable()->after('external_link');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['image_gallery', 'external_link', 'link_label']);
        });
    }
};
