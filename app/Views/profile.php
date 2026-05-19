<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - FoodSwipe</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
        }

        .profile-header h1 {
            color: #333;
            margin: 0;
            font-size: 28px;
        }

        .profile-header p {
            color: #666;
            margin: 10px 0 0 0;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.2);
        }

        .form-group input[readonly] {
            background-color: #f9f9f9;
            color: #999;
        }

        .alert {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #fee;
            border: 1px solid #fcc;
            color: #c00;
        }

        .alert-success {
            background-color: #efe;
            border: 1px solid #cfc;
            color: #060;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert li {
            margin-bottom: 5px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background-color: #e8e8e8;
        }

        .password-section {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
            border: 1px solid #eee;
        }

        .password-section .section-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .password-section .form-group {
            margin-bottom: 15px;
        }

        .note {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <nav style="background: #333; padding: 15px 30px;">
        <div style="max-width: 600px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
            <a href="/" style="color: white; text-decoration: none; font-weight: bold; font-size: 18px;">FoodSwipe</a>
            <div>
                <a href="/reservation/available-slots" style="color: white; text-decoration: none; margin-right: 20px;">Réservations</a>
                <a href="/" style="color: white; text-decoration: none; margin-right: 20px;">Accueil</a>
                <a href="/connexion/profile" style="color: #4CAF50; text-decoration: none; margin-right: 20px; font-weight: bold;">Mon Profil</a>
                <a href="/connexion/logout" style="color: white; text-decoration: none;">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="profile-container">
        <div class="profile-header">
            <h1>Mon Profil</h1>
            <p>Gérez vos informations personnelles</p>
        </div>

        <?php if (isset($success) && $success): ?>
            <div class="alert alert-success">
                ✓ <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="/connexion/update-profile">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" readonly>
                <div class="note">Votre adresse email ne peut pas être modifiée</div>
            </div>

            <div class="form-group">
                <label for="name">Nom Complet</label>
                <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            </div>

            <div class="password-section">
                <div class="section-title">Changer de mot de passe (optionnel)</div>
                
                <div class="form-group">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Laisser vide pour ne pas changer">
                    <div class="note">Minimum 6 caractères</div>
                </div>

                <div class="form-group">
                    <label for="password_confirm">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmer votre nouveau mot de passe">
                </div>
            </div>

            <div class="form-actions">
                <a href="/" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
        </form>

        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #999; font-size: 12px;">
            <p>Compte créé le: <?php echo $user['created_at']; ?></p>
        </div>
    </div>
</body>
</html>
