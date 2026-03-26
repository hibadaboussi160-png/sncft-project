<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Train; // استدعاء الموديل ضروري هنا

class TrainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // مسح البيانات القديمة لتفادي تكرار الـ ID أو train_number
        Train::truncate();

        // 1. خط تونس - صفاقس - قابس (الخط الرئيسي الجنوبي)
        Train::create([
            'train_number'   => 'T101',
            'nom'            => 'الجنوب السريع',
            'ligne'          => 'Tunis - Sfax - Gabes',
            'departure'      => 'Tunis',
            'destination'    => 'Gabes',
            'departure_time' => '06:00:00',
            'arrival_time'   => '12:30:00',
            'current_lat'    => 36.7985,
            'current_lng'    => 10.1805,
            'status'         => 'a_lheure',
            'retard'         => 0,
            'route'          => '[{"lat":36.7985,"lng":10.1805},{"lat":35.8245,"lng":10.6346},{"lat":34.7406,"lng":10.7603},{"lat":33.8833,"lng":10.0833}]'
        ]);

        // 2. خط تونس - باجة - جندوبة - غار الدماء (خط الشمال)
        Train::create([
            'train_number'   => 'T202',
            'nom'            => 'مكوك الشمال',
            'ligne'          => 'Tunis - Beja - Ghardimaou',
            'departure'      => 'Tunis',
            'destination'    => 'Ghardimaou',
            'departure_time' => '07:15:00',
            'arrival_time'   => '10:45:00',
            'current_lat'    => 36.7985,
            'current_lng'    => 10.1805,
            'status'         => 'a_lheure',
            'retard'         => 0,
            'route'          => '[{"lat":36.7985,"lng":10.1805},{"lat":36.7333,"lng":9.1833},{"lat":36.5011,"lng":8.7794},{"lat":36.4514,"lng":8.4414}]'
        ]);

        // 3. خط تونس - بنزرت
        Train::create([
            'train_number'   => 'T303',
            'nom'            => 'قطار بنزرت',
            'ligne'          => 'Tunis - Bizerte',
            'departure'      => 'Tunis',
            'destination'    => 'Bizerte',
            'departure_time' => '08:30:00',
            'arrival_time'   => '10:00:00',
            'current_lat'    => 36.7985,
            'current_lng'    => 10.1805,
            'status'         => 'retard',
            'retard'         => 10,
            'route'          => '[{"lat":36.7985,"lng":10.1805},{"lat":37.0667,"lng":9.9167},{"lat":37.2744,"lng":9.8739}]'
        ]);

        // 4. خط سوسة - المهدية (مترو الساحل)
        Train::create([
            'train_number'   => 'M404',
            'nom'            => 'مترو الساحل',
            'ligne'          => 'Sousse - Mahdia',
            'departure'      => 'Sousse',
            'destination'    => 'Mahdia',
            'departure_time' => '12:00:00',
            'arrival_time'   => '13:15:00',
            'current_lat'    => 35.8245,
            'current_lng'    => 10.6346,
            'status'         => 'a_lheure',
            'retard'         => 0,
            'route'          => '[{"lat":35.8245,"lng":10.6346},{"lat":35.7778,"lng":10.8261},{"lat":35.5047,"lng":11.0622}]'
        ]);

        // 5. خط القلعة الخصبة (الخط الغربي)
        Train::create([
            'train_number'   => 'T505',
            'nom'            => 'قطار الغرب',
            'ligne'          => 'Tunis - Kalâa Khasba',
            'departure'      => 'Tunis',
            'destination'    => 'Kalâa Khasba',
            'departure_time' => '05:45:00',
            'arrival_time'   => '11:00:00',
            'current_lat'    => 36.7985,
            'current_lng'    => 10.1805,
            'status'         => 'a_lheure',
            'retard'         => 0,
            'route'          => '[{"lat":36.7985,"lng":10.1805},{"lat":36.1681,"lng":9.1233},{"lat":35.7500,"lng":8.5167}]'
        ]);
    }
}