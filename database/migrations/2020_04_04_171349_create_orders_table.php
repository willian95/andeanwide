<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            // exchange info
            $table->unsignedBigInteger('symbol_id');
            $table->unsignedBigInteger('currency_sended_id');
            $table->unsignedBigInteger('currency_received_id');
            $table->unsignedBigInteger('priority_id');
            $table->string('priority', 50);
            $table->string('priority_label', 250);
            $table->string('priority_sublabel', 250)->nullable();
            $table->double('payment_amount');
            $table->double('transaction_cost');
            $table->double('priority_cost');
            $table->double('tax');
            $table->double('total_cost');
            $table->double('sended_amount');
            $table->double('exchange_rate');
            $table->double('received_amount');

            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();

            $table->string('payment_code', 16)->nullable();

            $table->timestamp('filled_at')->nullable();     // La orden ha sido completada por el usuario
            $table->timestamp('verified_at')->nullable();   // Cuando ha sido verificado el pago de la orden
            $table->timestamp('rejected_at')->nullable();   // La orden no procede y es cancelada por administracion
            $table->timestamp('expired_at')->nullable();    // La orden cumplio su tiempo, y fue cancelada
            $table->timestamp('completed_at')->nullable();  // La orden ha sido completada por administracion

            $table->string('reason', 255)->nullable();
            $table->text('observation')->nullable();


            // User info
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('orders');
    }
}
