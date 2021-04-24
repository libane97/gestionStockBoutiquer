<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->float('montant');
            $table->tinyInteger('is_client');
            $table->timestamps();

            /*creation des index*/
            $table->integer('user_id');
            $table->integer('typeoperation_id');
            $table->integer('service_id');

            /*migration des colonnes pour les index*/
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('typeoperation_id')->references('id')->on('typeoperations');
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
        Schema::dropIfExists('operations');
    }
}
