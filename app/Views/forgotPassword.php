<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Recuperar Contraseña</title>
  <link rel="stylesheet" href="/styles/login.css">
</head>
<body>
  <div class="login-container">
    <form action="/forgot-password" method="POST" class="login-form">
      <h2>Recuperar Contraseña</h2>
      <p>Introduce tu email y te enviaremos un enlace para restablecer tu contraseña.</p><br>
      <div class="form-group">
        <label for="email">Email:</label>
        <input id="email" name="email" type="email" required placeholder="tú@ejemplo.com">
      </div>
      <button type="submit" class="btn">Enviar Enlace</button>
    </form>
  </div>
</body>
</html>