<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Devoir;

class Epreuve extends Model
{
    use HasFactory;

    protected $fillable = [
        'annee',
        'session',
        'devoir_id',
    ];


    //le polymorphisme devoir et epreuve
    public function devoir()
    {
        return $this->morphOne(Devoir::class, 'devoirable');
    }

    public function correction():BelongsTo
    {
        return $this->belongsTo(Correction::class);
    }

}
