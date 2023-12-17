<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['nazev', 'pocet'];

    public function competitors()
    {
        return $this->hasMany(Competitor::class);
    }
}
