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
        Schema::create('lampirans', function (Blueprint $table) {
            $table->id();
            $table->string('lampiran_nu');
            $table->string('username');
            $table->tinyInteger('status');
            $table->string('doctor_nu');
            $table->string('outlet_nu');
            $table->string('product_nu');
            $table->decimal('price_at_that_time', 15, 2);
            $table->unsignedMediumInteger('quantity')->nullable();
            $table->decimal('percent', 5, 2);
            $table->decimal('sales', 15, 2);
            $table->boolean('is_expired')->default(false);
            $table->string('created_by');
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
        Schema::dropIfExists('lampirans');
    }
};
