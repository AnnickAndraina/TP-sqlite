<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Créneaux - FoodSwipe Admin</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body { background: #f5f5f5; }
        .admin-container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .page-header h1 { margin: 0; }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn:hover { background: #764ba2; }
        .btn-danger {
            background: #f44336;
        }
        .btn-danger:hover {
            background: #d32f2f;
        }
        .table-container {
            background: white;
            border-radius: 8px;
            overflow-x: auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #667eea;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover { background: #f9f9f9; }
        .active-badge {
            display: inline-block;
            padding: 5px 10px;
            background: #4caf50;
            color: white;
            border-radius: 3px;
            font-size: 12px;
        }
        .inactive-badge {
            display: inline-block;
            padding: 5px 10px;
            background: #f44336;
            color: white;
            border-radius: 3px;
            font-size: 12px;
        }
        .action-btns { display: flex; gap: 10px; }
        .action-btns .btn {
            padding: 8px 15px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="page-header">
            <h1>📅 Gestion des Créneaux</h1>
            <a href="/admin/creneaux/create" class="btn">+ Ajouter un créneau</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ressource</th>
                        <th>Date</th>
                        <th>Horaire</th>
                        <th>Places</th>
                        <th>Disponibles</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($creneaux as $creneau): ?>
                    <tr>
                        <td>#<?= $creneau['id'] ?></td>
                        <td><?= $creneau['ressource'] ?></td>
                        <td><?= $creneau['date'] ?></td>
                        <td><?= $creneau['time'] ?></td>
                        <td><?= $creneau['places'] ?></td>
                        <td><?= $creneau['available'] ?></td>
                        <td>
                            <?php if ($creneau['active']): ?>
                                <span class="active-badge">Actif</span>
                            <?php else: ?>
                                <span class="inactive-badge">Inactif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="/admin/creneaux/<?= $creneau['id'] ?>/edit" class="btn">Éditer</a>
                                <form action="/admin/creneaux/<?= $creneau['id'] ?>/delete" method="POST" style="display: inline;">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            <a href="/admin" class="btn" style="background: #999;">← Retour au dashboard</a>
        </div>
    </div>
</body>
</html>
