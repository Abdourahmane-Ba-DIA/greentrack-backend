<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EcoTip;

class EcoTipSeeder extends Seeder
{
    public function run()
    {
        EcoTip::insert([
            [
                'title' => 'Utilisez les transports en commun',
                'content' => 'Privilégiez le bus, le métro ou le tramway.',
                'category' => 'transport',
                'impact_level' => 'high',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Réduisez la consommation de viande rouge',
                'content' => 'Consommez plus de protéines végétales.',
                'category' => 'alimentation',
                'impact_level' => 'high',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
