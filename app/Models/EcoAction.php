<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcoAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'impact_co2',
        'impact_water',
        'impact_waste',
        'date',
    ];

    protected $casts = [
        'impact_co2' => 'float',
        'impact_water' => 'float',
        'impact_waste' => 'float',
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
