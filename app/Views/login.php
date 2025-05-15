<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Acceder</title>
  <link rel="stylesheet" href="/styles/login.css">
</head>
<body>
  <div class="login-container">
    <form action="/login" method="POST" class="login-form">
      <h2>Iniciar Sesión</h2>
      <div class="form-group">
        <label for="email">Email:</label>
        <input id="email" name="email" type="email" required placeholder="tú@ejemplo.com">
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input id="password" name="password" type="password" required placeholder="••••••••">
      </div>
      <div class="form-links">
        <a href="/register" class="link">Registrarse</a>
        <a href="/forgot-password" class="link">¿Olvidaste tu contraseña?</a>
      </div>
      <button type="submit" class="btn">Entrar</button>
    </form>
  </div>
</body>
</html>