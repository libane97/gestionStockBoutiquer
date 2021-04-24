<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJourneesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journees', function (Blueprint $table) {
            $table->increments('id');
            $table->float('depart');
            $table->float('recharge');
            $table->float('retrait');
            $table->tinyInteger('boucle');
            $table->timestamps();

            /*creation des index*/
            $table->integer('user_id');
            $table->integer('service_id');

            /*migration des colonnes pour les index*/
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journees');
    }
}
