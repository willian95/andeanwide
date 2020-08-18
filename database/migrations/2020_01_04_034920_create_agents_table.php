<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('r_legal_name', 128)->nullable();
            $table->string('r_legal_lastname', 128)->nullable();
            $table->string('r_nationality', 56)->nullable();
            $table->date('r_birthday')->nullable();
            $table->string('r_pais_residencia', 128)->nullable();
            $table->string('r_rut', 56)->nullable();
            $table->string('r_serie', 56)->nullable();
            $table->string('r_telefono', 20)->nullable();

            $table->string('e_name', 128)->unique();
            $table->string('e_fantasy', 128)->nullable();
            $table->string('e_rut', 56);
            $table->string('e_address', 256)->nullable();
            $table->string('e_city', 56)->nullable();
            $table->string('e_country', 56)->nullable();
            $table->string('e_zip', 20)->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::table('agents', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('agents');
            
    }
}
