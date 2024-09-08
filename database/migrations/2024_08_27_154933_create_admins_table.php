<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('admins', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('email')->unique();
      $table->string('phone')->unique()->nullable();
      $table->string('avatar')->nullable();
      $table->unsignedInteger('role_id')->default(1);
      //let us assume role_id 1 is superadmin
      $table->string('password');
      $table->string('code')->unique()->nullable();
      $table->rememberToken();
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('admins');
  }
}
