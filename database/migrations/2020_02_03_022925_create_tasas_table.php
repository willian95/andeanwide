<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('origen', ['CLP', 'COP', 'EUR']);
            $table->enum('destino', ['CLP', 'COP', 'EUR', 'VES']);
            $table->decimal('dias2', 10, 4);
            $table->decimal('dias1', 10, 4)->nullable();
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
        Schema::dropIfExists('tasas');
    }
}
