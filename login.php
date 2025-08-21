<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Corrija Aí</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="stylelogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
        <div class="form-box login">
            <form action="auth.php" method="POST">
                <input type="hidden" name="action" value="login">
                <h1>Login</h1>
                <div class="input-box">
                  <input type="email" name="email" placeholder="E-mail" required>
                  <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                  <input type="password" name="password" placeholder="Senha" required>
                  <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="forgot-link">
                  <a href="">Esqueceu a senha?</a>
                </div>
                <button type="submit" class="bottom">Login</button>
            </form>
        </div>

        <div class="form-box register">
          <form action="auth.php" method="POST">
            <input type="hidden" name="action" value="cadastro">
            <h1>Cadastro</h1>
            <div class="input-box">
              <input type="text" name="name" placeholder="Nome Completo" required>
              <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
              <input type="email" name="email" placeholder="E-mail" required>
              <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
              <input type="password" name="password" placeholder="Senha (mín. 6 caracteres)" required>
              <i class='bx bxs-lock-alt'></i>
            </div>
            <button type="submit" class="bottom">Cadastre-se</button>
          </form>
        </div>

        <div class="toggle-box">
          <div class="toggle-panel toggle-left">
            <h1>Seja bem-vindo!</h1>
            <p>Não tem uma conta?</p>
            <button class="bottom register-bottom">Cadastre-se</button>
          </div>

          <div class="toggle-panel toggle-right">
            <h1>Bem-vindo de volta!</h1>
            <p>Já tem uma conta?</p>
            <button class="bottom login-bottom">Login</button>
          </div>
        </div>
    </div>

    <!-- Exibir mensagens de erro se houver -->
    <?php
    session_start();
    if (isset($_SESSION['erros'])) {
        echo '<div id="error-messages" style="position: fixed; top: 20px; right: 20px; background: #ff4757; color: white; padding: 15px; border-radius: 8px; z-index: 1000; max-width: 300px;">';
        foreach ($_SESSION['erros'] as $erro) {
            echo '<p style="margin: 5px 0;">' . htmlspecialchars($erro) . '</p>';
        }
        echo '<button onclick="this.parentElement.style.display=\'none\'" style="background: none; border: none; color: white; float: right; cursor: pointer; font-size: 18px; margin-top: -5px;">×</button>';
        echo '</div>';
        unset($_SESSION['erros']); // Limpar os erros após exibir
    }
    
    // Se já estiver logado, redirecionar para início
    if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
        header("Location: inicio.html");
        exit();
    }
    ?>

    <script src="scriptlogin.js"></script>
    <script>
    // Auto-hide error messages after 5 seconds
    setTimeout(function() {
        const errorDiv = document.getElementById('error-messages');
        if (errorDiv) {
            errorDiv.style.display = 'none';
        }
    }, 5000);
    </script>
  </body>
</html>