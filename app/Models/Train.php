<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    protected $fillable = [
        'train_number', 'nom', 'ligne', 'departure', 'destination',
        'departure_time', 'arrival_time', 'current_lat', 'current_lng',
        'status', 'retard', 'route'
    ];

    // هذا السطر هو المسؤول الوحيد عن تحويل الـ JSON إلى Array تلقائياً
    protected $casts = [
        'route' => 'array',
    ];
}