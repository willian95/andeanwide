<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSymbolsTableAdditionalFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('symbols', function (Blueprint $table) {
            $table->boolean('show_inverse')->default(false);
            $table->unsignedBigInteger('max_tier_1')->default(0);
            $table->unsignedBigInteger('max_tier_2')->default(0);
            $table->integer('decimals')->default(4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('symbols', function (Blueprint $table) {
            $table->dropColumn(['show_inverse', 'max_tier_1', 'max_tier_2', 'decimals']);
        });
    }
}
