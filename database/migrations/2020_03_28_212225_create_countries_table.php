<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('abbr', 3);
            $table->enum('continent', [
                'North America',
                'Asia',
                'Africa',
                'Europe',
                'South America',
                'Oceania',
                'Antarctica',
            ])->nullable();
            $table->string('city',150)->nullable();
            $table->string('currency', 50);
            $table->string('symbol', 3);
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
        Schema::dropIfExists('countries');
    }
}
