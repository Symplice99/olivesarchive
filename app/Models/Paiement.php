<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'jour',
        'mois',
        'annee',
        'heure',
        'id_paiement',
        'client_id',
        'cour_id',
        'devoir_id',
        'correction_id',
    ];
}
