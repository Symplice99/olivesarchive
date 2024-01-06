<?php

namespace App\Models;

use App\Models\Niveau;
use App\Models\Domaine;
use App\Models\Matiere;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cour extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'taile',
        'description',
        'classe',
        'fichier',
        'niveau_id',
        'matiere_id',
        'domaine_id',

        
    ];

    public function domaine():BelongsTo{
        return $this->belongsTo(Domaine::class);
    }

    public function niveau():BelongsTo{
        return $this->belongsTo(Niveau::class);
    }
    public function matiere():BelongsTo{
        return $this->belongsTo(Matiere::class,);
    }
}
