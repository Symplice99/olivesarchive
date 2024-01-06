<?php

namespace App\Models;

use App\Models\Epreuve;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Devoir extends Model
{
    use HasFactory;
    protected $fillable = [
        'autre',
        'description',
        'complexite',
        'filiere',
        'type',
        'fichierdev',
        'tarif',
        'taille',
        'compteur',
        'datepub',
        'matiere_id',
    ];


    public function matiere():BelongsTo{
        return $this->belongsTo(Matiere::class,);
    }

    //le polymorphise entre devoir, epreuve et exercice
    public function devoirable(){
        return $this->morphTo();
    }

}
