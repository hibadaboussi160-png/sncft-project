<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNCFT — تتبع مباشر</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #0f172a; }
        #header {
            position: absolute; top: 0; left: 0; right: 0;
            z-index: 1000; background: #0f172a;
            padding: 10px 20px;
            display: flex; align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #1e3a5f;
        }
        #header h1 { color: #e2e8f0; font-size: 17px; }
        #filtres { display: flex; gap: 6px; flex-wrap: wrap; }
        .btn-zone {
            padding: 4px 12px; border-radius: 20px;
            border: 1px solid #1e3a5f; background: transparent;
            color: #94a3b8; cursor: pointer; font-size: 12px;
            transition: all 0.2s;
        }
        .btn-zone:hover, .btn-zone.active {
            background: #1d4ed8; color: white; border-color: #1d4ed8;
        }
        #map { position: absolute; top: 54px; left: 0; right: 0; bottom: 0; }
        .popup-gare { font-family: Arial; min-width: 200px; }
        .popup-gare h3 { margin-bottom: 6px; font-size: 15px; }
        .popup-row {
            display: flex; justify-content: space-between;
            font-size: 13px; padding: 3px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .popup-row span:first-child { color: #64748b; }
        .popup-row span:last-child  { color: #1e293b; font-weight: 500; }
        #compteur {
            position: absolute; bottom: 20px; left: 20px;
            z-index: 1000; background: #0f172acc;
            color: #94a3b8; font-size: 12px;
            padding: 6px 12px; border-radius: 20px;
            border: 1px solid #1e3a5f;
        }
    </style>
</head>
<body>

<div id="header">
    <h1>🚉 SNCFT — تتبع مباشر</h1>
    <div id="filtres">
        <button class="btn-zone active" onclick="filtrerZone('ALL', this)">Toutes</button>
        <button class="btn-zone" onclick="filtrerZone('NORD', this)">Nord</button>
        <button class="btn-zone" onclick="filtrerZone('EST', this)">Est</button>
        <button class="btn-zone" onclick="filtrerZone('SUDEST', this)">Sud Est</button>
        <button class="btn-zone" onclick="filtrerZone('CENTRE', this)">Centre</button>
        <button class="btn-zone" onclick="filtrerZone('SUD', this)">Sud</button>
    </div>
</div>

<div id="map"></div>
<div id="compteur">Chargement...</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const map = L.map('map').setView([36.8065, 10.1815], 7);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

const couleurStatut = {
    'a_heure': '#22c55e',
    'retard': '#f59e0b',
    'annule': '#ef4444',
};

const statutLabel = {
    'a_heure': '✅ À l\'heure',
    'retard': '⏳ Retard',
    'annule': '❌ Annulé',
};

const marqueurTrains = {};
const marqueurGares = [];

// Liste des gares avec coordonnées
const gares = [
    { nom: "Tunis", lat: 36.8065, lng: 10.1815, zone: "NORD" },
    { nom: "Sfax", lat: 34.7400, lng: 10.7600, zone: "SUDEST" },
    { nom: "Gabes", lat: 33.8833, lng: 10.0833, zone: "SUD" },
    { nom: "Bizerte", lat: 37.2744, lng: 9.8739, zone: "NORD" },
    { nom: "Ghardimaou", lat: 36.4514, lng: 8.4441, zone: "NORD" },
    { nom: "Sousse", lat: 35.8245, lng: 10.6346, zone: "CENTRE" },
    { nom: "Mahdia", lat: 35.5047, lng: 11.0622, zone: "SUDEST" },
];

// Afficher les gares
function chargerGares() {
    gares.forEach(gare => {
        const marker = L.circleMarker([gare.lat, gare.lng], {
            radius: 6,
            color: "#1d4ed8",
            fillColor: "#3b82f6",
            fillOpacity: 0.9
        }).addTo(map);
        marker.bindPopup(`<b>🚉 Gare ${gare.nom}</b><br>Zone: ${gare.zone}`);
        marqueurGares.push(marker);
    });
}
chargerGares();

// Charger les trains
async function chargerTrains() {
    const response = await fetch("/api/trains");
    const trains = await response.json();

    document.getElementById("compteur").textContent = `🚂 ${trains.length} trains suivis`;

    trains.forEach(train => {
        const couleur = couleurStatut[train.status] || '#94a3b8';
        const icone = L.divIcon({
            className: '',
            html: `<div style="width:18px;height:18px;background:${couleur};border-radius:50%;border:3px solid white;box-shadow:0 0 10px ${couleur};"></div>`,
            iconAnchor: [9, 9],
        });

        const popup = `
            <div class="popup-gare">
                <h3 style="color:#f59e0b;">🚂 ${train.nom}</h3>
                <div class="popup-row"><span>Numéro</span><span>${train.train_number}</span></div>
                <div class="popup-row"><span>Ligne</span><span>${train.ligne}</span></div>
                <div class="popup-row"><span>Départ</span><span>${train.departure} — ${train.departure_time}</span></div>
                <div class="popup-row"><span>Arrivée</span><span>${train.destination} — ${train.arrival_time}</span></div>
                <div class="popup-row"><span>Statut</span><span>${statutLabel[train.status]}${train.retard > 0 ? ' (+' + train.retard + ' min)' : ''}</span></div>
            </div>
        `;

        const lat = parseFloat(train.current_lat) || 36.8065;
        const lng = parseFloat(train.current_lng) || 10.1815;

        if (marqueurTrains[train.id]) {
            marqueurTrains[train.id].setLatLng([lat, lng]);
            marqueurTrains[train.id].setIcon(icone);
            marqueurTrains[train.id].setPopupContent(popup);
        } else {
            marqueurTrains[train.id] = L.marker([lat, lng], { icon: icone })
                .addTo(map)
                .bindPopup(popup);
        }

        if (train.route && train.route.length > 1) {
            try {
                const coords = JSON.parse(train.route).map(p => [p.lat, p.lng]);
                L.polyline(coords, { color: couleur, weight: 3, opacity: 0.7 }).addTo(map);
            } catch(e) {}
        }
    });
}

chargerTrains();
setInterval(chargerTrains, 60000);
</script>

</body>
</html>
