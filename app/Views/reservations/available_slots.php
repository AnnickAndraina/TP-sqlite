<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créneaux disponibles - FoodSwipe</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .slots-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }
        .slot-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .slot-info {
            flex: 1;
        }
        .slot-date {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .slot-time {
            font-size: 16px;
            color: #666;
            margin: 5px 0;
        }
        .slot-places {
            font-size: 14px;
            color: #999;
        }
        .reserve-btn {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .reserve-btn:hover {
            background: #ff5252;
        }
        .no-slots {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="slots-container">
        <h1>Créneaux disponibles</h1>
        
        <?php if (empty($slots)): ?>
            <div class="no-slots">
                <p>Aucun créneau disponible pour le moment</p>
            </div>
        <?php else: ?>
            <?php foreach ($slots as $slot): ?>
                <div class="slot-card">
                    <div class="slot-info">
                        <div class="slot-date"><?= date('d/m/Y', strtotime($slot['date'])) ?></div>
                        <div class="slot-time">
                            <?= date('H:i', strtotime($slot['time_start'])) ?> - 
                            <?= date('H:i', strtotime($slot['time_end'])) ?>
                        </div>
                        <div class="slot-places">
                            <?= $slot['available_places'] ?> place(s) disponible(s)
                        </div>
                    </div>
                    <button class="reserve-btn" onclick="reserveSlot(<?= $slot['id'] ?>)">
                        Réserver
                    </button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script>
        function reserveSlot(slotId) {
            fetch('/reservation/create-reservation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'slot_id=' + slotId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Réservation confirmée!');
                    location.reload();
                } else {
                    alert('Erreur: ' + data.message);
                }
            })
            .catch(error => alert('Erreur: ' + error));
        }
    </script>
</body>
</html>
