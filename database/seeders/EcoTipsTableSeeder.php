<?php

namespace Database\Seeders;

use App\Models\EcoTip;
use Illuminate\Database\Seeder;

class EcoTipsTableSeeder extends Seeder
{
    public function run()
    {
        $tips = [
            // Transport
            [
                'title' => 'Utilisez les transports en commun',
                'content' => 'Privilégiez le bus, le métro ou le tramway pour vos déplacements quotidiens. Cela réduit considérablement votre empreinte carbone.',
                'category' => 'transport',
                'impact_level' => 'high'
            ],
            [
                'title' => 'Covoiturage pour le travail',
                'content' => 'Partagez votre trajet domicile-travail avec des collègues. Vous économiserez de l\'argent et réduirez les émissions.',
                'category' => 'transport',
                'impact_level' => 'medium'
            ],
            [
                'title' => 'Vélo pour les courtes distances',
                'content' => 'Pour les trajets de moins de 5km, le vélo est la solution idéale : zéro émission et bon pour la santé!',
                'category' => 'transport',
                'impact_level' => 'medium'
            ],

            // Alimentation
            [
                'title' => 'Réduisez la viande rouge',
                'content' => 'Remplacez la viande rouge par des protéines végétales une fois par semaine. L\'élevage bovin est très émetteur de CO2.',
                'category' => 'alimentation',
                'impact_level' => 'high'
            ],
            [
                'title' => 'Achetez local et de saison',
                'content' => 'Les produits locaux et de saison nécessitent moins de transport et de chauffage de serres.',
                'category' => 'alimentation',
                'impact_level' => 'medium'
            ],
            [
                'title' => 'Évitez le gaspillage alimentaire',
                'content' => 'Planifiez vos menus et utilisez vos restes. Le gaspillage alimentaire représente 8% des émissions mondiales.',
                'category' => 'alimentation',
                'impact_level' => 'high'
            ],

            // Énergie
            [
                'title' => 'Baisser le chauffage de 1°C',
                'content' => 'Réduire la température de 1°C peut diminuer votre consommation énergétique de 7%.',
                'category' => 'energy',
                'impact_level' => 'medium'
            ],
            [
                'title' => 'Éteignez les appareils en veille',
                'content' => 'Les appareils en veille consomment de l\'électricité inutilement. Utilisez des multiprises avec interrupteur.',
                'category' => 'energy',
                'impact_level' => 'low'
            ],
            [
                'title' => 'Ampoules LED',
                'content' => 'Remplacez vos ampoules classiques par des LED qui consomment 80% d\'énergie en moins.',
                'category' => 'energy',
                'impact_level' => 'medium'
            ],

            // Déchets
            [
                'title' => 'Compostez vos déchets organiques',
                'content' => 'Le compostage réduit les déchets envoyés en décharge et produit un excellent engrais naturel.',
                'category' => 'dechets',
                'impact_level' => 'medium'
            ],
            [
                'title' => 'Refusez les emballages inutiles',
                'content' => 'Préférez les produits en vrac et refusez les sacs plastique jetables.',
                'category' => 'dechets',
                'impact_level' => 'high'
            ],
            [
                'title' => 'Réparation plutôt que remplacement',
                'content' => 'Avant de jeter un objet, voyez s\'il peut être réparé. Vous économiserez des ressources.',
                'category' => 'dechets',
                'impact_level' => 'medium'
            ],
        ];

        foreach ($tips as $tip) {
            EcoTip::create($tip);
        }
    }
}