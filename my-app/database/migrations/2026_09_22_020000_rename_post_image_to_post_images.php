<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE post_image RENAME TO post_images');
        DB::statement('ALTER TABLE post_images CHANGE title url VARCHAR(128) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE post_images CHANGE url title VARCHAR(128) NOT NULL');
        DB::statement('ALTER TABLE post_images RENAME TO post_image');
    }
};
