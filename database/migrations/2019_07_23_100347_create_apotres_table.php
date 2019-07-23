<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApotresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apotres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('apotre_name');
            $table->string('apotre_surname');
            $table->date('apotre_dateNais');
            $table->string('apotre_paroisse');
            $table->string('apotre_zone');
            $table->string('apotre_status');
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
        Schema::dropIfExists('apotres');
    }
}
