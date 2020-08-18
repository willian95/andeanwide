<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbols', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->double('default_amount')->default(0);
            $table->double('min_amount')->default(0);
            $table->string('name',10);
            $table->string('api_class')->nullable();
            $table->text('observation')->nullable();
            $table->unsignedBigInteger('base_cur_id');
            $table->unsignedBigInteger('quote_cur_id');
            $table->enum('spread_by', ['point', 'percentage'])->default('percentage');
            $table->double('spread_value')->default(0);
            $table->double('offset')->default(0);
            $table->enum('offset_by', ['point', 'percentage'])->default('percentage');
            $table->double('min_pip_value')->default(1);
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
        Schema::dropIfExists('symbols');
    }
}
