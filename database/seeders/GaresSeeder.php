<?php

namespace Database\Seeders;

use App\Models\Gare;
use Illuminate\Database\Seeder;

class GaresSeeder extends Seeder
{
    public function run(): void
    {
        $gares = [
            // NORD — Siège: BEJA
            ['nom'=>'Beja',      'zone'=>'NORD', 'siege'=>'BEJA',   'lat'=>36.7333, 'lng'=>9.1833,  'telephone'=>'78 451 340'],
            ['nom'=>'Bizerte',   'zone'=>'NORD', 'siege'=>'BEJA',   'lat'=>37.2744, 'lng'=>9.8739,  'telephone'=>'72 431 071'],
            ['nom'=>'Mateur',    'zone'=>'NORD', 'siege'=>'BEJA',   'lat'=>37.0397, 'lng'=>9.6636,  'telephone'=>'72 465 025'],
            ['nom'=>'Le Kef',    'zone'=>'NORD', 'siege'=>'BEJA',   'lat'=>36.1833, 'lng'=>8.7167,  'telephone'=>'78 223 061'],
            ['nom'=>'Bousalem',  'zone'=>'NORD', 'siege'=>'BEJA',   'lat'=>36.6333, 'lng'=>8.9667,  'telephone'=>'78 639 735'],
            ['nom'=>'Jendouba',  'zone'=>'NORD', 'siege'=>'BEJA',   'lat'=>36.5011, 'lng'=>8.7803,  'telephone'=>'78 603 161'],

            // EST — Siège: SOUSSE
            ['nom'=>'Sousse',    'zone'=>'EST',  'siege'=>'SOUSSE', 'lat'=>35.8245, 'lng'=>10.6346, 'telephone'=>'73 225 177'],
            ['nom'=>'Mahdia',    'zone'=>'EST',  'siege'=>'SOUSSE', 'lat'=>35.5047, 'lng'=>11.0622, 'telephone'=>'73 680 177'],
            ['nom'=>'Monastir',  'zone'=>'EST',  'siege'=>'SOUSSE', 'lat'=>35.7643, 'lng'=>10.8113, 'telephone'=>'73 460 000'],
            ['nom'=>'Nabeul',    'zone'=>'EST',  'siege'=>'SOUSSE', 'lat'=>36.4561, 'lng'=>10.7375, 'telephone'=>'72 286 000'],
            ['nom'=>'Hammamet',  'zone'=>'EST',  'siege'=>'SOUSSE', 'lat'=>36.4000, 'lng'=>10.6167, 'telephone'=>'72 280 000'],

            // NORD EST — Siège: TUNIS
            ['nom'=>'Tunis',         'zone'=>'NORD EST', 'siege'=>'TUNIS', 'lat'=>36.7985, 'lng'=>10.1805, 'telephone'=>'71 261 800'],
            ['nom'=>'La Marsa',      'zone'=>'NORD EST', 'siege'=>'TUNIS', 'lat'=>36.8833, 'lng'=>10.3167, 'telephone'=>'71 740 000'],
            ['nom'=>'La Goulette',   'zone'=>'NORD EST', 'siege'=>'TUNIS', 'lat'=>36.8183, 'lng'=>10.3050, 'telephone'=>'71 735 000'],
            ['nom'=>'Ben Arous',     'zone'=>'NORD EST', 'siege'=>'TUNIS', 'lat'=>36.7533, 'lng'=>10.2283, 'telephone'=>'71 380 000'],
            ['nom'=>'Bir Bou Regba', 'zone'=>'NORD EST', 'siege'=>'TUNIS', 'lat'=>36.3667, 'lng'=>10.5333, 'telephone'=>'72 317 027'],

            // SUD EST — Siège: SFAX
            ['nom'=>'Sfax',      'zone'=>'SUD EST',   'siege'=>'SFAX',    'lat'=>34.7406, 'lng'=>10.7603, 'telephone'=>'74 224 466'],
            ['nom'=>'El Ajem',   'zone'=>'SUD EST',   'siege'=>'SFAX',    'lat'=>35.2936, 'lng'=>10.7183, 'telephone'=>'73 690 000'],
            ['nom'=>'Maknassy',  'zone'=>'SUD EST',   'siege'=>'SFAX',    'lat'=>34.6000, 'lng'=>9.9000,  'telephone'=>'76 645 292'],
            ['nom'=>'Skhira',    'zone'=>'SUD EST',   'siege'=>'SFAX',    'lat'=>34.3000, 'lng'=>10.0667, 'telephone'=>'74 490 000'],

            // CENTRE — Siège: GAFOUR
            ['nom'=>'Gaafour',   'zone'=>'CENTRE',    'siege'=>'GÂAFOUR', 'lat'=>36.3333, 'lng'=>9.3167,  'telephone'=>'78 851 000'],
            ['nom'=>'Siliana',   'zone'=>'CENTRE',    'siege'=>'GÂAFOUR', 'lat'=>36.0833, 'lng'=>9.3667,  'telephone'=>'78 870 000'],
            ['nom'=>'Bouarada',  'zone'=>'CENTRE',    'siege'=>'GÂAFOUR', 'lat'=>36.3500, 'lng'=>9.5333,  'telephone'=>'78 805 150'],

            // SUD OUEST — Siège: GAFSA
            ['nom'=>'Gafsa',     'zone'=>'SUD OUEST', 'siege'=>'GAFSA',   'lat'=>34.4167, 'lng'=>8.7833,  'telephone'=>'76 224 900'],
            ['nom'=>'Metlaoui',  'zone'=>'SUD OUEST', 'siege'=>'GAFSA',   'lat'=>34.3333, 'lng'=>8.4000,  'telephone'=>'76 241 000'],
            ['nom'=>'Tozeur',    'zone'=>'SUD OUEST', 'siege'=>'GAFSA',   'lat'=>33.9197, 'lng'=>8.1336,  'telephone'=>'76 452 000'],
            ['nom'=>'Redeyef',   'zone'=>'SUD OUEST', 'siege'=>'GAFSA',   'lat'=>34.3833, 'lng'=>8.1500,  'telephone'=>'76 300 000'],

            // SUD — Siège: GABES
            ['nom'=>'Gabes',     'zone'=>'SUD',       'siege'=>'GABES',   'lat'=>33.8833, 'lng'=>10.0833, 'telephone'=>'75 270 944'],
            ['nom'=>'Ghannouch', 'zone'=>'SUD',       'siege'=>'GABES',   'lat'=>33.9333, 'lng'=>10.0333, 'telephone'=>'75 240 000'],
            ['nom'=>'Medenine',  'zone'=>'SUD',       'siege'=>'GABES',   'lat'=>33.3547, 'lng'=>10.5053, 'telephone'=>'75 640 000'],
        ];

        foreach ($gares as $gare) {
            Gare::create($gare);
        }
    }
}