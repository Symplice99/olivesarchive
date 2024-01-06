<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomcomplet',
        'pays',
        'ville',
        'phone',
        'adresse',
        'fonction',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
