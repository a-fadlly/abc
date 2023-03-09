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
        Schema::table('lampirans', function (Blueprint $table) {
            $table->foreign('username')->references('username')->on('users');
            $table->foreign('doctor_nu')->references('doctor_nu')->on('doctors');
            $table->foreign('outlet_nu')->references('outlet_nu_uni')->on('outlets');
            $table->foreign('product_nu')->references('product_nu')->on('products');
            $table->foreign('created_by')->references('username')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lampirans', function (Blueprint $table) {
            $table->dropForeign(['username']);
            $table->dropForeign(['outlet_nu']);
            $table->dropForeign(['product_nu']);
            $table->dropForeign(['created_by']);
        });
    }
};
