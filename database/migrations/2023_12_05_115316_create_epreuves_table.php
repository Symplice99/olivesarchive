<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('epreuves', function (Blueprint $table) {
            $table->increments('id');
            $table->string('annee')->nullable();
            $table->string('session')->nullable();

            $table->integer('devoir_id')->unsigned()->nullable();
            $table->foreign('devoir_id')->references('id')->on('devoirs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epreuves');
    }
};
