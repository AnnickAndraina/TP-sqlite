<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Ressource - FoodSwipe Admin</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body { background: #f5f5f5; }
        .admin-container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .form-card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-card h1 { margin-top: 0; color: #333; }
        .form-group { margin-bottom: 20px; }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-primary {
            background: #667eea;
            color: white;
        }
        .btn-primary:hover { background: #764ba2; }
        .btn-secondary {
            background: #999;
            color: white;
        }
        .btn-secondary:hover { background: #777; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="form-card">
            <h1>➕ Ajouter une Ressource</h1>
            
            <form action="/admin/ressources/store" method="POST">
                <div class="form-group">
                    <label for="name">Nom de la ressource *</label>
                    <input type="text" id="name" name="name" placeholder="ex: Salle Réunion A" required>
                </div>

                <div class="form-group">
                    <label for="type">Type de ressource *</label>
                    <select id="type" name="type" required>
                        <option value="">-- Sélectionner un type --</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type ?>"><?= ucfirst($type) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="capacity">Capacité (nombre de places) *</label>
                    <input type="number" id="capacity" name="capacity" min="1" max="500" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Décrivez cette ressource..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Créer la ressource</button>
                    <a href="/admin/ressources" class="btn btn-secondary" style="text-decoration: none; text-align: center;">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
