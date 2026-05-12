<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FitSpace</title>
  <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
  <section id="page-login" style="background:var(--surface);">
  <nav class="nav-public">
    <a href="#" class="brand">Fit<span>Space</span></a>
  </nav>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-logo">Fit<span>Space</span></div>
      <div class="auth-subtitle">Bienvenue ! Connectez-vous à votre espace.</div>

      <!-- Flashdata erreur CI4 -->
      <div class="flash-message flash-error">
        <i class="bi bi-exclamation-circle-fill"></i>
        Email ou mot de passe incorrect.
      </div>

      <form method="post">
        <div class="form-group mb-3">
          <label class="form-label" >Adresse email</label>
          <input type="email" id="login-email" class="form-control" placeholder="votre@email.com" />
        </div>
        <div class="form-group mb-4">
          <label class="form-label" id="login-pwd">Mot de passe</label>
          <input type="password" id="login-pwd" class="form-control" placeholder="••••••••" />
        </div>

        <div class="flash-message flash-error" >
          <i class="bi bi-exclamation-circle-fill" id="login-error"></i>
          Email ou mot de passe incorrect.
        </div>

        <button type="submit" class="btn-primary-custom" onclick="doLogin()" >Se connecter</button>
      </form>

      <hr class="auth-divider" />
      <div class="auth-footer">Pas encore de compte ? <a href="#page-inscription">Créer un compte</a></div>
    </div>
  </div>
</section>


<script>
  function doLogin() {
    event.preventDefault();
    const email = document.getElementById('login-email').value.trim();
    const pwd   = document.getElementById('login-pwd').value;
    const err   = document.getElementById('login-error');

    if (!email || !pwd) {
      err.textContent = 'Veuillez remplir tous les champs.';
      err.classList.add('visible');
      return;
    }

    err.classList.remove('visible');

    // Persist user session
    const user = JSON.parse(localStorage.getItem('fs_user') || 'null');
    if (user && user.email === email && user.pwd === pwd) {
      localStorage.setItem('fs_logged', 'true');
      window.location.href = '/home';
    } else if (!user) {
      // Demo mode : first login always works
      localStorage.setItem('fs_user', JSON.stringify({ name: 'Invité', email, pwd }));
      localStorage.setItem('fs_logged', 'true');
      window.location.href = '/home';
    } else {
      err.textContent = 'Email ou mot de passe incorrect.';
      err.classList.add('visible');
    }
  }

  // Already logged in → redirect
  if (localStorage.removeItem('fs_logged');) {
    window.location.href = '/home';
}
// //  document.addEventListener('keydown', e => { if (e.key === 'Enter') doLogin(); });
// </script>

</body>
</html>
