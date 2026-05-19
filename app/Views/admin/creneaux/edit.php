<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer un Créneau - FoodSwipe Admin</title>
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
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input:focus, select:focus {
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
            <h1>✏️ Éditer le Créneau #<?= $creneau['id'] ?></h1>
            
            <form action="/admin/creneaux/<?= $creneau['id'] ?>/update" method="POST">
                <div class="form-group">
                    <label for="ressource">Ressource *</label>
                    <select id="ressource" name="ressource_id" required>
                        <?php foreach ($ressources as $res): ?>
                            <option value="<?= $res['id'] ?>" <?= $res['id'] == $creneau['ressource_id'] ? 'selected' : '' ?>>
                                <?= $res['name'] ?> (<?= $res['type'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Date *</label>
                    <input type="date" id="date" name="date" value="<?= $creneau['date'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="time_start">Heure de début *</label>
                    <input type="time" id="time_start" name="time_start" value="<?= $creneau['time_start'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="time_end">Heure de fin *</label>
                    <input type="time" id="time_end" name="time_end" value="<?= $creneau['time_end'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="places">Nombre de places *</label>
                    <input type="number" id="places" name="places" value="<?= $creneau['places'] ?>" min="1" max="100" required>
                </div>

                <div class="form-group" style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin-top: 20px;">
                    <strong>Places disponibles:</strong> <?= $creneau['available'] ?>
                    <br>
                    <em style="color: #999;">(Calculé après les réservations)</em>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="/admin/creneaux" class="btn btn-secondary" style="text-decoration: none; text-align: center;">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
