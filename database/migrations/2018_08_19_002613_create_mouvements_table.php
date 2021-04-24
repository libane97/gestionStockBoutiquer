<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMouvementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mouvements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->float('encaissement');
            $table->float('decaissement');
            $table->timestamps();

            /*creation des index*/
            $table->integer('caisse_id');
            $table->integer('service_id');

            /*migration des colonnes pour les index*/
            $table->foreign('caisse_id')->references('id')->on('caisses');
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
        Schema::dropIfExists('mouvements');
    }
}
