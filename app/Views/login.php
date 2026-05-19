<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FoodSwipe - Connexion</title>
  <link rel="stylesheet" href="/css/style.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .auth-wrapper {
      width: 100%;
      max-width: 400px;
      padding: 20px;
    }
    .auth-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.2);
      padding: 40px;
    }
    .auth-logo {
      font-size: 28px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 10px;
      color: #333;
    }
    .auth-subtitle {
      text-align: center;
      color: #666;
      margin-bottom: 30px;
      font-size: 14px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-label {
      display: block;
      margin-bottom: 8px;
      color: #333;
      font-weight: 500;
      font-size: 14px;
    }
    .form-control {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }
    .form-control:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    .flash-message {
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 13px;
    }
    .flash-error {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    .flash-success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    .btn-primary-custom {
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s ease;
    }
    .btn-primary-custom:hover {
      transform: translateY(-2px);
    }
    .auth-divider {
      margin: 20px 0;
      border: none;
      border-top: 1px solid #eee;
    }
    .auth-footer {
      text-align: center;
      color: #666;
      font-size: 14px;
    }
    .auth-footer a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
    }
    .auth-footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-logo">🍽️ FoodSwipe</div>
      <div class="auth-subtitle">Connectez-vous à votre compte</div>

      <form method="post" action="/connexion/do-login">
        <?php if (session()->getFlashdata('error')): ?>
          <div class="flash-message flash-error">
            <?= session()->getFlashdata('error') ?>
          </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
          <div class="flash-message flash-success">
            <?= session()->getFlashdata('success') ?>
          </div>
        <?php endif; ?>

        <div class="form-group">
          <label class="form-label">Adresse email</label>
          <input type="email" name="email" class="form-control" placeholder="votre@email.com" required />
        </div>
        <div class="form-group">
          <label class="form-label">Mot de passe</label>
          <input type="password" name="password" class="form-control" placeholder="••••••••" required />
        </div>

        <button type="submit" class="btn-primary-custom">Se connecter</button>
      </form>

      <hr class="auth-divider" />
      <div class="auth-footer">Pas encore de compte ? <a href="/inscription">Créer un compte</a></div>
    </div>
  </div>
</body>
</html>