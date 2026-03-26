<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gare extends Model
{
    protected $fillable = [
        'nom',
        'zone',
        'siege',
        'lat',
        'lng',
        'telephone',
    ];
}