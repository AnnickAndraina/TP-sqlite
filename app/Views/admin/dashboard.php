<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - FoodSwipe Admin</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            background: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .admin-header h1 {
            margin: 0;
            color: #333;
        }
        
        .admin-nav {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .nav-link {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        .nav-link:hover {
            background: #764ba2;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-card h3 {
            margin: 0 0 10px 0;
            color: #999;
            font-size: 14px;
            text-transform: uppercase;
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
        }
        
        .stat-card.warning .stat-value {
            color: #ff9800;
        }
        
        .stat-card.danger .stat-value {
            color: #f44336;
        }
        
        .stat-card.success .stat-value {
            color: #4caf50;
        }
        
        .recent-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .recent-section h2 {
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #667eea;
            padding-bottom: 15px;
        }
        
        .reservations-list {
            display: grid;
            gap: 15px;
        }
        
        .reservation-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #667eea;
            border-radius: 4px;
        }
        
        .reservation-info h4 {
            margin: 0 0 5px 0;
            color: #333;
        }
        
        .reservation-info p {
            margin: 0;
            font-size: 14px;
            color: #999;
        }
        
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-confirmed {
            background: #c8e6c9;
            color: #2e7d32;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1>🔧 Tableau de bord Administrateur</h1>
            <div class="admin-nav">
                <a href="/admin/creneaux" class="nav-link">Créneaux</a>
                <a href="/admin/reservations" class="nav-link">Réservations</a>
                <a href="/admin/ressources" class="nav-link">Ressources</a>
                <a href="/admin/users" class="nav-link">Utilisateurs</a>
                <a href="/connexion/logout" class="nav-link" style="background: #f44336;">Déconnexion</a>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Utilisateurs</h3>
                <div class="stat-value"><?= $stats['total_users'] ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Réservations</h3>
                <div class="stat-value"><?= $stats['total_reservations'] ?></div>
            </div>
            <div class="stat-card warning">
                <h3>Réservations Aujourd'hui</h3>
                <div class="stat-value"><?= $stats['reservations_today'] ?></div>
            </div>
            <div class="stat-card danger">
                <h3>En Attente</h3>
                <div class="stat-value"><?= $stats['reservations_pending'] ?></div>
            </div>
            <div class="stat-card">
                <h3>Ressources</h3>
                <div class="stat-value"><?= $stats['total_resources'] ?></div>
            </div>
            <div class="stat-card success">
                <h3>Taux d'Occupation</h3>
                <div class="stat-value"><?= round($stats['occupancy_rate'] * 100) ?>%</div>
            </div>
        </div>

        <div class="recent-section">
            <h2>Dernières Réservations</h2>
            <div class="reservations-list">
                <?php foreach ($recent_reservations as $res): ?>
                    <div class="reservation-item">
                        <div class="reservation-info">
                            <h4><?= $res['ressource'] ?></h4>
                            <p><?= $res['user_email'] ?> - <?= $res['date'] ?></p>
                        </div>
                        <span class="status-badge status-<?= $res['status'] ?>">
                            <?= ucfirst($res['status']) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
