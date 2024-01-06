<?php

namespace App\Models;

use App\Models\Cour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Niveau extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomniv',
    ];

    public function cours():HasMany{
        return $this->hasMany(Cour::class);
    }
}
