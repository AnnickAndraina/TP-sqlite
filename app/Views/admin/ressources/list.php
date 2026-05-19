<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Ressources - FoodSwipe Admin</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body { background: #f5f5f5; }
        .admin-container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
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
            transition: background 0.3s;
        }
        .btn:hover { background: #764ba2; }
        .resource-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .resource-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .resource-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .resource-card h3 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .resource-type {
            display: inline-block;
            padding: 5px 10px;
            background: #667eea;
            color: white;
            border-radius: 3px;
            font-size: 12px;
            margin-bottom: 10px;
        }
        .resource-info {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }
        .resource-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .resource-actions a {
            flex: 1;
            padding: 8px;
            text-align: center;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 12px;
        }
        .resource-actions a:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="page-header">
            <h1>🏢 Gestion des Ressources</h1>
            <a href="/admin/ressources/create" class="btn">+ Ajouter une ressource</a>
        </div>

        <div class="resource-grid">
            <?php foreach ($ressources as $res): ?>
                <div class="resource-card">
                    <h3><?= $res['name'] ?></h3>
                    <span class="resource-type"><?= ucfirst($res['type']) ?></span>
                    <div class="resource-info">
                        <strong>Capacité:</strong> <?= $res['capacity'] ?> personne(s)
                    </div>
                    <div class="resource-info">
                        <strong>Description:</strong><br>
                        <?= $res['description'] ?>
                    </div>
                    <div class="resource-actions">
                        <a href="#">Éditer</a>
                        <a href="#" style="background: #f44336;">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="margin-top: 30px;">
            <a href="/admin" class="btn" style="background: #999;">← Retour au dashboard</a>
        </div>
    </div>
</body>
</html>
