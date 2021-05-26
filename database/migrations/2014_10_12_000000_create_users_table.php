<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->default('');
            $table->string('slug')->default('');
            $table->string('email')->unique();
            $table->integer('role_id');
            $table->string('country_code')->default('');
            $table->string('mob_no')->default('');
            $table->string('dob')->default('');
            $table->string('gender')->nullable();
            $table->integer('status')->default('1');
            $table->integer('t_c')->default('1');
            $table->string('otp')->default('');
            $table->string('is_email_verified')->default('');
            $table->string('token')->default('');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
