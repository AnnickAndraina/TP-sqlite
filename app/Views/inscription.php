<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FoodSwipe — Inscription</title>
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
      padding: 20px;
    }
    .auth-wrapper {
      width: 100%;
      max-width: 500px;
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
    .form-grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
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
      display: none;
    }
    .flash-error.visible {
      display: block;
    }
    .form-error {
      color: #e74c3c;
      font-size: 13px;
      margin-bottom: 15px;
      display: none;
    }
    .form-error.visible {
      display: block;
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
    .mb-3 {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-logo">🍽️ FoodSwipe</div>
      <div class="auth-subtitle">Créez votre compte gratuitement</div>

      <form method="post" action="/connexion/do-register" onsubmit="validateForm(event)">
        <?php if (session()->getFlashdata('error')): ?>
          <div class="flash-message flash-error visible">
            <?= session()->getFlashdata('error') ?>
          </div>
        <?php endif; ?>

        <div class="form-grid-2 mb-3">
          <div class="form-group">
            <label class="form-label">Prénom</label>
            <input type="text" name="first_name" class="form-control" placeholder="Jean" />
          </div>
          <div class="form-group">
            <label class="form-label">Nom</label>
            <input type="text" name="last_name" class="form-control" placeholder="Dupont" />
          </div>
        </div>

        <div class="form-group mb-3">
          <label class="form-label">Adresse email</label>
          <input type="email" name="email" class="form-control" placeholder="jean.dupont@email.com" required />
        </div>

        <div class="form-group mb-3">
          <label class="form-label">Mot de passe</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="8 caractères minimum" required />
        </div>

        <div class="form-group mb-3">
          <label class="form-label">Confirmer le mot de passe</label>
          <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Retapez votre mot de passe" required />
        </div>

        <p class="form-error" id="reg-error"></p>
        
        <button type="submit" class="btn-primary-custom">Créer mon compte</button>
      </form>

      <hr class="auth-divider" />
      <div class="auth-footer">Déjà inscrit ? <a href="/login">Se connecter</a></div>
    </div>
  </div>

  <script>
    function validateForm(event) {
      const firstName = document.querySelector('input[name="first_name"]').value.trim();
      const lastName = document.querySelector('input[name="last_name"]').value.trim();
      const email = document.querySelector('input[name="email"]').value.trim();
      const password = document.getElementById('password').value;
      const passwordConfirm = document.getElementById('password_confirm').value;
      const errorEl = document.getElementById('reg-error');

      if (!firstName || !lastName || !email || !password || !passwordConfirm) {
        errorEl.textContent = 'Veuillez remplir tous les champs.';
        errorEl.classList.add('visible');
        event.preventDefault();
        return false;
      }

      if (password.length < 8) {
        errorEl.textContent = 'Le mot de passe doit contenir au moins 8 caractères.';
        errorEl.classList.add('visible');
        event.preventDefault();
        return false;
      }

      if (password !== passwordConfirm) {
        errorEl.textContent = 'Les mots de passe ne correspondent pas.';
        errorEl.classList.add('visible');
        event.preventDefault();
        return false;
      }

      errorEl.classList.remove('visible');
      return true;
    }
  </script>
</body>
</html>
