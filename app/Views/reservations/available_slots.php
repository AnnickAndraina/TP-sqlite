<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendrier des réservations</title>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<style>
body{font-family:Arial;background:#f4f6fb;margin:0;padding:20px}
.dashboard{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;margin-bottom:25px}
.card{background:white;padding:20px;border-radius:14px;box-shadow:0 2px 10px rgba(0,0,0,.08)}
.card h3{margin:0;color:#777;font-size:14px}
.value{font-size:30px;font-weight:bold;color:#5b6cf0;margin-top:10px}
#calendar{background:white;padding:20px;border-radius:14px;box-shadow:0 2px 10px rgba(0,0,0,.08)}
.fc-event{cursor:pointer}
</style>
</head>
<body>

<h1>📅 Calendrier hebdomadaire interactif</h1>

<div class="dashboard">
<div class="card">
<h3>Total des séances</h3>
<div class="value"><?= $stats['total_seances'] ?></div>
</div>

<div class="card">
<h3>Dernière réservation</h3>
<div class="value" style="font-size:20px"><?= $stats['derniere_reservation'] ?></div>
</div>

<div class="card">
<h3>Taux de présence</h3>
<div class="value"><?= $stats['taux_presence'] ?>%</div>
</div>
</div>

<div id="calendar"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'timeGridWeek',
        locale: 'fr',
        height: 'auto',
        slotMinTime: '07:00:00',
        slotMaxTime: '22:00:00',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridWeek,timeGridDay,dayGridMonth'
        },
        events: [
            <?php foreach($slots as $slot): ?>
            {
                id: '<?= $slot['id'] ?>',
                title: '<?= $slot['ressource_nom'] ?> (<?= $slot['available_places'] ?> places)',
                start: '<?= $slot['date'] ?>T<?= $slot['time_start'] ?>',
                end: '<?= $slot['date'] ?>T<?= $slot['time_end'] ?>'
            },
            <?php endforeach; ?>
        ],
        eventClick: function(info) {
            fetch('/reservation/create-reservation', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'slot_id=' + info.event.id
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
            });
        }
    });

    calendar.render();
});
</script>
</body>
</html>
