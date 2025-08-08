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
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider')->nullable()->after('password');
            $table->string('provider_id')->nullable()->after('provider');
            $table->string('facebook_id')->nullable()->after('provider_id');
            $table->string('google_id')->nullable()->after('facebook_id');
            $table->json('social_tokens')->nullable()->after('google_id');
            $table->string('avatar_url')->nullable()->after('social_tokens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'provider',
                'provider_id', 
                'facebook_id',
                'google_id',
                'social_tokens',
                'avatar_url'
            ]);
        });
    }
};
