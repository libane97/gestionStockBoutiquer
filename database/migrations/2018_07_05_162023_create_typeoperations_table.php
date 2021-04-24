<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeoperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typeoperations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom'); # Retrait service || Retrait compte || Depot service || Depot compte
            $table->tinyInteger('signe'); # 1 || -1
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
        Schema::dropIfExists('typeoperations');
    }
}
