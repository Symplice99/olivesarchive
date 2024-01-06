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
        Schema::create('corrections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pubdate')->nullable();
            $table->string('fichiercor');
            $table->integer('montant')->nullable();

            $table->integer('exercice_id')->unsigned()->nullable();
            $table->foreign('exercice_id')->references('id')->on('exercices');
            $table->integer('epreuve_id')->unsigned()->nullable();
            $table->foreign('epreuve_id')->references('id')->on('epreuves');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corrections');
    }
};
