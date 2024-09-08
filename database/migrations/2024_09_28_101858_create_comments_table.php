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
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id')->nullable(); // Foreign key to users table
      $table->unsignedBigInteger('blog_id')->nullable(); // Foreign key to posts or blogs table
      $table->unsignedBigInteger('post_id')->nullable(); // Foreign key to posts or blogs table
      $table->text('content'); // Comment content
      $table->timestamps();

      // Foreign key constraints
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade'); // Assuming 'posts' table
      $table->foreign('blog_id')->references('id')->on('posts')->onDelete('cascade'); // Assuming 'posts' table
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('comments');
  }
};
