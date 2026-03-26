<?php

namespace App\Console\Commands;

use App\Events\TrainPositionUpdated;
use App\Models\Train;
use Illuminate\Console\Command;

class SimulateTrains extends Command
{
    protected $signature   = 'trains:simulate';
    protected $description = 'Simule le mouvement des trains';

    public function handle(): void
    {
        $this->info('Simulation démarrée! Ctrl+C pour arrêter.');

        // نجلب كل القطارات من القاعدة
        $trains  = Train::all();
        
        // إذا لم توجد قطارات، نخرج لتفادي الأخطاء
        if ($trains->isEmpty()) {
            $this->error('Pas de trains trouvés dans la base de données.');
            return;
        }

        $indices = array_fill(0, count($trains), 0);

        while (true) {
            foreach ($trains as $i => $train) {
                // التعديل المهم هنا: نضمن أن الـ route مصفوفة
                $route = is_array($train->route) ? $train->route : json_decode($train->route, true);
                
                // إذا المسار فارغ نتخطى هذا القطار
                if (empty($route)) continue;

                $idx      = $indices[$i];
                $next     = ($idx + 1) % count($route); // هنا لن يظهر خطأ TypeError بعد الآن
                $progress = (time() % 8) / 8;

                // حساب الإحداثيات الجديدة
                $lat = $route[$idx]['lat'] + ($route[$next]['lat'] - $route[$idx]['lat']) * $progress;
                $lng = $route[$idx]['lng'] + ($route[$next]['lng'] - $route[$idx]['lng']) * $progress;

                // تحديث قاعدة البيانات بالأسماء الصحيحة للأعمدة
                $train->update([
                    'current_lat' => $lat, 
                    'current_lng' => $lng, 
                ]);

                // إرسال التنبيه للـ Frontend (Real-time)
                event(new TrainPositionUpdated($train));

                if (time() % 8 === 0) {
                    $indices[$i] = $next;
                }
            }

            $this->info('Update: ' . now()->toTimeString());
            sleep(1); // تقليل وقت النوم ليكون التحريك أسلس
        }
    }
}