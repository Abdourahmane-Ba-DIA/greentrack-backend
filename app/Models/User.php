<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // nécessaire si tu utilises Sanctum

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Les attributs assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Les attributs masqués pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relation avec le profil utilisateur.
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Relation avec les actions écologiques.
     */
    public function ecoActions()
    {
        return $this->hasMany(EcoAction::class);
    }

    /**
     * Créer le profil utilisateur après la création de l'user.
     */
    protected static function booted()
    {
        parent::booted();

        static::created(function ($user) {
            $user->profile()->create([
                'eco_score' => 0,
                'total_co2_saved' => 0,
                'total_water_saved' => 0,
                'total_waste_reduced' => 0,
            ]);
        });
    }
}
