<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Correction extends Model
{
    use HasFactory;
    protected $fillable = [
        'pubdate',
        'fichiercor',
        'montant',
        'exercice_id',
        'epreuve_id',
    ];


    public function epreuve():BelongsTo
    {
        return $this->belongsTo(Epreuve::class);
    }

    public function exercice():BelongsTo
    {
        return $this->belongsTo(Exercice::class);
    }
}
