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
        Schema::create('devoirables', function (Blueprint $table) {
            $table->increments('id');//ok cool
            $table->unsignedBigInteger('devoir_id');//id de la table devoirs //super
            $table->unsignedBigInteger('devoirable_id');//devoirable_id stocke l'ID de l'entité associée (par exemple, un Epreuve ou un Exercice) <= et on va pas ajouter exercice_id?
            $table->string('devoirable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devoirables');
    }
};
