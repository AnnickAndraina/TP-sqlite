<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes réservations - FoodSwipe</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .reservations-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }
        .reservation-card {
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
        .reservation-info {
            flex: 1;
        }
        .reservation-date {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .reservation-time {
            font-size: 16px;
            color: #666;
            margin: 5px 0;
        }
        .reservation-status {
            font-size: 14px;
            color: #27ae60;
            padding: 5px 10px;
            background: #ecf0f1;
            border-radius: 4px;
            display: inline-block;
            margin-top: 5px;
        }
        .cancel-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .cancel-btn:hover {
            background: #c0392b;
        }
        .no-reservations {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="reservations-container">
        <h1>Mes réservations</h1>
        
        <?php if (empty($reservations)): ?>
            <div class="no-reservations">
                <p>Vous n'avez aucune réservation pour le moment</p>
                <a href="/reservation/available-slots">Voir les créneaux disponibles</a>
            </div>
        <?php else: ?>
            <?php foreach ($reservations as $reservation): ?>
                <div class="reservation-card">
                    <div class="reservation-info">
                        <div class="reservation-date">
                            <?= date('d/m/Y', strtotime($reservation['date'])) ?>
                        </div>
                        <div class="reservation-time">
                            <?= date('H:i', strtotime($reservation['time_start'])) ?> - 
                            <?= date('H:i', strtotime($reservation['time_end'])) ?>
                        </div>
                        <div class="reservation-status">
                            <?= ucfirst($reservation['status']) ?>
                        </div>
                    </div>
                    <?php if ($reservation['status'] !== 'cancelled'): ?>
                        <button class="cancel-btn" onclick="cancelReservation(<?= $reservation['id'] ?>)">
                            Annuler
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script>
        function cancelReservation(reservationId) {
            if (confirm('Êtes-vous sûr de vouloir annuler cette réservation?')) {
                fetch('/reservation/cancel-reservation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'reservation_id=' + reservationId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Réservation annulée');
                        location.reload();
                    } else {
                        alert('Erreur: ' + data.message);
                    }
                })
                .catch(error => alert('Erreur: ' + error));
            }
        }
    </script>
</body>
</html>
