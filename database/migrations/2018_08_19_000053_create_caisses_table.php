<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaissesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caisses', function (Blueprint $table) {
            $table->increments('id');
            $table->float('veille');
            $table->float('appro')->nullable();
            $table->float('solde')->nullable();
            $table->float('creance')->nullble();
            $table->dateTime('date');
            $table->dateTime('fermeture')->nullable();
            $table->integer('statut')->default(0);
            $table->timestamps();

            /*creation des index*/
            $table->integer('user_id');

            /*migration des colonnes pour les index*/
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caisses');
    }
}
