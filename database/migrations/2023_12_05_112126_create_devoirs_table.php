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
        Schema::create('devoirs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('taille');
            $table->string('autre');
            $table->text('description');
            $table->string('complexite');
            $table->string('filiere');
            $table->string('type');
            $table->string('fichierdev');
            $table->integer('tarif');
            $table->integer('compteur')->nullable();
            $table->integer('devoirable_id')->nullable();
            $table->string('devoirable_type')->nullable();
            $table->string('datepub')->nullable();
            $table->integer('matiere_id')->unsigned()->nullable();
            $table->foreign('matiere_id')->references('id')->on('matieres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devoirs');
    }
};
