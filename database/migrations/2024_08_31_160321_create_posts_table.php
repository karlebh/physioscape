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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('post_category_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('title');
            $table->string('photo')->nullable();
            $table->string('video')->nullable();
            $table->text('except');
            $table->longtext('content');
            $table->boolean('comments')->default(true);
            $table->boolean('reactions')->default(true);
            $table->json('tags');
            $table->json('resources')->nullable();
            $table->dateTime('scheduled_at')->nullable();
            $table->boolean('media')->default(false);
            $table->boolean('featured')->default(false);
            $table->boolean('visible')->default(true);
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
