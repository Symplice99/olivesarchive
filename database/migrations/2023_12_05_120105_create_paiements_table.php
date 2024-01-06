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
        Schema::create('paiements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jour')->nullable();
            $table->string('mois')->nullable();
            $table->string('annee')->nullable();
            $table->string('heure')->nullable();
            $table->string('id_paiement')->nullable();

            $table->integer('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->integer('cour_id')->unsigned()->nullable();
            $table->foreign('cour_id')->references('id')->on('cours');

            $table->integer('devoir_id')->unsigned()->nullable();
            $table->foreign('devoir_id')->references('id')->on('devoirs');

            $table->integer('correction_id')->unsigned()->nullable();
            $table->foreign('correction_id')->references('id')->on('corrections');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
