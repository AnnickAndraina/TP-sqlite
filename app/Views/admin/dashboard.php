<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body{font-family:Arial;background:#f4f6fb;margin:0;padding:20px}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px}
.card,.chart-card{background:white;padding:20px;border-radius:15px;box-shadow:0 2px 12px rgba(0,0,0,.08)}
.value{font-size:32px;font-weight:bold;color:#4f46e5}
.chart-container{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:25px}
table{width:100%;border-collapse:collapse}
th,td{padding:12px;border-bottom:1px solid #eee;text-align:left}
@media(max-width:900px){.chart-container{grid-template-columns:1fr}}
</style>
</head>
<body>

<h1>📊 Tableau de bord Administrateur enrichi</h1>

<div class="grid">
<div class="card"><h3>Utilisateurs</h3><div class="value"><?= $stats['total_users'] ?></div></div>
<div class="card"><h3>Réservations</h3><div class="value"><?= $stats['total_reservations'] ?></div></div>
<div class="card"><h3>Réservations aujourd'hui</h3><div class="value"><?= $stats['reservations_today'] ?></div></div>
<div class="card"><h3>Taux occupation</h3><div class="value"><?= intval($stats['occupancy_rate']*100) ?>%</div></div>
</div>

<div class="chart-container">
<div class="chart-card">
<h2>Occupation par semaine</h2>
<canvas id="occupationChart"></canvas>
</div>

<div class="chart-card">
<h2>Ressources les plus réservées</h2>
<canvas id="resourceChart"></canvas>
</div>
</div>

<div class="chart-card" style="margin-top:25px">
<h2>Dernières réservations</h2>
<table>
<tr><th>Utilisateur</th><th>Ressource</th><th>Date</th><th>Status</th></tr>
<?php foreach($recent_reservations as $reservation): ?>
<tr>
<td><?= $reservation['user_email'] ?></td>
<td><?= $reservation['ressource'] ?></td>
<td><?= $reservation['date'] ?></td>
<td><?= $reservation['status'] ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>

<script>
new Chart(document.getElementById('occupationChart'), {
type:'line',
data:{
labels:['Sem 1','Sem 2','Sem 3','Sem 4'],
datasets:[{
label:'Occupation (%)',
data:[65,78,82,91],
borderWidth:3,
fill:true
}]
}
});

new Chart(document.getElementById('resourceChart'), {
type:'bar',
data:{
labels:['Salle A','Studio','Terrasse','Atelier'],
datasets:[{
label:'Réservations',
data:[32,21,18,12],
borderWidth:1
}]
}
});
</script>

</body>
</html>
