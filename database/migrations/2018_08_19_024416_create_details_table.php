<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nombre');

            /*creation des index*/
            $table->integer('caisse_id');
            $table->integer('monnaie_id');

            /*migration des colonnes pour les index*/
            $table->foreign('caisse_id')->references('id')->on('caisses');
            $table->foreign('monnaie_id')->references('id')->on('monnaies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
    }
}
