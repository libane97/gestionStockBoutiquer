<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero')->unique();
            $table->float('montant');
            $table->timestamps();

            /*creation des index*/
            $table->integer('user_id');
            $table->integer('operation_id');
            $table->integer('compte_id');

            /*migration des colonnes pour les index*/
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->foreign('compte_id')->references('id')->on('comptes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
