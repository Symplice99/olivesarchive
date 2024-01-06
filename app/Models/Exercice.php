<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exercice extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'devoir_id',
    ];

    //le polymorphisme devoir et exercice
    public function devoir()
    {
        return $this->morphOne(Devoir::class, 'devoirable');
    }

    public function correction():BelongsTo
    {
        return $this->belongsTo(Correction::class);
    }

}
