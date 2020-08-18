<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id');
            $table->string('nationality');
            $table->string('first_name', 150);
            $table->string('middle_name', 150)->nullable();
            $table->string('last_name', 150);
            $table->string('second_surname', 150)->nullable();
            $table->string('dni_number',150);
            $table->string('validation_number',150)->nullable();
            $table->date('expiration_date');
            $table->date('issue_date');
            $table->date('dob');
            $table->enum('document_type', ['dni', 'passport', 'drive_license']);
            $table->enum('gender', ['Unknown', 'F', 'M'])->default('Unknown');
            $table->timestamp('verified_at')->nullable();
            $table->string('front_image_url')->nullable();
            $table->string('reverse_image_url')->nullable();
            $table->timestamps();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('identities', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('identities');
    }
}
