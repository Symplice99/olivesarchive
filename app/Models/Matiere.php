<?php

namespace App\Models;

use App\Models\Cour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matiere extends Model
{
    use HasFactory;
    protected $fillable = [
        'nommat',
    ];

    public function cours():HasMany{
        return $this->hasMany(Cour::class,);
    }

    public function epreuves():HasMany{
        return $this->HasMany(Epreuve::class,);
    }
}
