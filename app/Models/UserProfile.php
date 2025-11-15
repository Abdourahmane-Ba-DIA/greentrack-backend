<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'eco_score',
        'total_co2_saved',
        'total_water_saved',
        'total_waste_reduced',
    ];

    protected $casts = [
        'eco_score' => 'integer',
        'total_co2_saved' => 'float',
        'total_water_saved' => 'float',
        'total_waste_reduced' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
