<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('$2y$10$OY93W.JrpBbgyqg08ZnNeOuZ4i/C4xVbWk20GA6OFmaCCTCGmVj7S');
            $table->string('role');
            $table->string('reporting_manager')->nullable();
            $table->string('reporting_manager_manager')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('additional_details')->nullable();
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
};
