<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/api/trains', function () {
    $response = Http::get('https://www.sncft.com.tn/tempreel/');
    $html = $response->body();

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    libxml_clear_errors();

    $rows = $dom->getElementsByTagName('tr');
    $trains = [];

    // قائمة المحطات مع الإحداثيات
    $gares = [
        "Tunis" => ["lat" => 36.8065, "lng" => 10.1815],
        "Sfax" => ["lat" => 34.7400, "lng" => 10.7600],
        "Gabes" => ["lat" => 33.8833, "lng" => 10.0833],
        "Bizerte" => ["lat" => 37.2744, "lng" => 9.8739],
        "Ghardimaou" => ["lat" => 36.4514, "lng" => 8.4441],
        "Sousse" => ["lat" => 35.8245, "lng" => 10.6346],
        "Mahdia" => ["lat" => 35.5047, "lng" => 11.0622],
    ];

    foreach ($rows as $i => $row) {
        if ($i == 0) continue; // تجاهل العناوين
       $cols = $row->childNodes;
        if ($cols->length >= 5) {
            $arrivee   = trim($cols->item(0)->textContent);
            $prevision = trim($cols->item(1)->textContent);
            $numero    = trim($cols->item(2)->textContent);
            $type      = trim($cols->item(3)->textContent);
            $origine   = trim($cols->item(4)->textContent);

            $status = "a_heure";
            if (str_contains($prevision, "Annulé")) $status = "annule";
            elseif ($arrivee !== $prevision) $status = "retard";

            $trains[] = [
                "id" => $i,
                "nom" => "قطار " . $origine . " - " . $arrivee,
                "ligne" => $origine . " - " . $arrivee,
                "train_number" => $numero,
                "departure" => $origine,
                "destination" => $arrivee,
                "departure_time" => $prevision,
                "arrival_time" => $arrivee,
                "status" => $status,
                "retard" => ($status === "retard") ? 10 : 0,
                "current_lat" => $gares[$origine]["lat"] ?? 36.8065,
                "current_lng" => $gares[$origine]["lng"] ?? 10.1815,
                "route" => [
                    ["lat" => $gares[$origine]["lat"] ?? 36.8065, "lng" => $gares[$origine]["lng"] ?? 10.1815],
                    ["lat" => $gares[$arrivee]["lat"] ?? 36.8065, "lng" => $gares[$arrivee]["lng"] ?? 10.1815],
                ]
            ];
        }
    }

    return response()->json($trains);
});
