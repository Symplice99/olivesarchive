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
        Schema::create('cours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            //$table->string('matiere');
            $table->text('description');
            $table->string('classe');
            $table->string('fichier');
            $table->string('taile')->nullable();
            $table->integer('niveau_id')->unsigned()->nullable();
            $table->foreign('niveau_id')->references('id')->on('niveaux');

            $table->integer('matiere_id')->unsigned()->nullable();
            $table->foreign('matiere_id')->references('id')->on('matieres');

            $table->integer('domaine_id')->unsigned()->nullable();
            $table->foreign('domaine_id')->references('id')->on('domaines');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
