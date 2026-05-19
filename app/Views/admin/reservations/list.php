<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réservations - FoodSwipe Admin</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body { background: #f5f5f5; }
        .admin-container { max-width: 1400px; margin: 0 auto; padding: 20px; }
        .page-header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .page-header h1 { margin: 0; }
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
        }
        td { padding: 15px; border-bottom: 1px solid #ddd; }
        tr:hover { background: #f9f9f9; }
        .status-select {
            padding: 6px;
            border: 1px solid #ddd;
            border-radius: 3px;
            cursor: pointer;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-confirmed { background: #c8e6c9; color: #2e7d32; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="page-header">
            <h1>📋 Gestion des Réservations</h1>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Ressource</th>
                        <th>Date/Heure</th>
                        <th>Créée</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $res): ?>
                    <tr>
                        <td>#<?= $res['id'] ?></td>
                        <td><?= $res['user'] ?></td>
                        <td><?= $res['email'] ?></td>
                        <td><?= $res['resource'] ?></td>
                        <td><?= $res['date'] ?></td>
                        <td><?= $res['created'] ?></td>
                        <td>
                            <span class="status-badge status-<?= $res['status'] ?>">
                                <?= ucfirst($res['status']) ?>
                            </span>
                        </td>
                        <td>
                            <select class="status-select" onchange="changeStatus(<?= $res['id'] ?>, this.value)">
                                <option value="">-- Changer --</option>
                                <option value="confirmed">Confirmer</option>
                                <option value="pending">Attente</option>
                                <option value="cancelled">Annuler</option>
                            </select>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            <a href="/admin" class="btn" style="display: inline-block; padding: 10px 20px; background: #999; color: white; text-decoration: none; border-radius: 5px;">← Retour</a>
        </div>
    </div>

    <script>
        function changeStatus(id, status) {
            if (!status) return;
            
            fetch('/admin/reservations/' + id + '/status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'status=' + status
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Erreur: ' + data.message);
                }
            });
        }
    </script>
</body>
</html>
