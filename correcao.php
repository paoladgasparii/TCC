<?php
require_once 'verificar_sessao.php';
require_once 'config.php';
verificar_login();
$usuario = obter_usuario_logado();

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $temaSelecionado = trim($_POST['list'] ?? '');
    $temaLivre = trim($_POST['tema_livre_input'] ?? '');
    $titulo = trim($_POST['name'] ?? '');
    $redacao_texto = trim($_POST['message'] ?? '');

    $temaFinal = ($temaSelecionado === 'Tema Livre' && !empty($temaLivre)) ? $temaLivre : $temaSelecionado;


    if (empty($temaFinal) || empty($redacao_texto)) {
        $message = 'Por favor, preencha o tema e o texto da redação.';
        $messageType = 'error';
    } else {
        $id = uniqid('redacao_', true);
        
        $data_envio = date('Y-m-d'); 

        $stmt = $pdo->prepare(
            "INSERT INTO redacoes (id, usuario_id, aluno_nome, tema, titulo, texto, data_envio) VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        if ($stmt->execute([$id, $usuario['id'], $usuario['nome'], $temaFinal, $titulo, $redacao_texto, $data_envio])) {
            $message = 'Redação enviada com sucesso! Você pode acompanhar o status na aba Histórico.';
            $messageType = 'success';
        } else {
            $message = 'Ocorreu um erro ao enviar sua redação. Tente novamente.';
            $messageType = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Corrija Aí - Correção</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylecorrecao.css" />
  </head>
  
  <body>
    <main>
      <div class="big-wrapper light">
        <header>
          <div class="container1">
            <div class="logo">
              <img src="logo.png" alt="Logo" />
            </div>

            <div class="links">
              <ul>
                <li><a href="inicio.php">Início</a></li>
                <li><a href="aulas.php">Vídeoaulas</a></li>
                <li><a href="temas.php">Temas</a></li>
                <li><a href="correcao.php">Correção</a></li>
                <li><a href="historico.php">Histórico</a></li>
                <?php if ($usuario['is_admin']): ?>
                <li><a href="admin/index.php">Admin</a></li>
                <?php endif; ?>
                <li><a href="logout.php" style="color: #dc3545; margin-left: 360px;">Sair</a></li>

              </ul>
            </div>
            <div class="hamburger-menu">
              <div class="bar"></div>
            </div>
          </div>
        </header>

        <div class="form-container">
          <div class="form-card">
            <div class="form-header">
              <h1 class="form-title">Correção de Redação</h1>
              <p class="form-subtitle">Envie sua redação e receba uma correção detalhada baseada nos critérios do ENEM</p>
            </div>

            <?php if (!empty($message)): ?>
            <div class="message-container">
              <div class="<?php echo $messageType; ?>"><?php echo htmlspecialchars($message); ?></div>
            </div>
            <?php endif; ?>

            <form action="correcao.php" method="POST">
              <label for="list">Tema</label>
              <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder=" Escolha o tema da sua redação" name="list" required>
              <datalist id="datalistOptions">
                <option value="Tema Livre"></option>
                <option value="Desafios para a valorização da herança africana no Brasil"></option>
                <option value="Desafios para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil"></option>
                <option value="Desafios para a valorização de comunidades e povos tradicionais no Brasil"></option>
                <option value="Invisibilidade e registro civil: garantia de acesso à cidadania no Brasil"></option>
                <option value="O estigma associado às doenças mentais na sociedade brasileira"></option>
                <option value="Democratização do acesso ao cinema no Brasil"></option>
                <option value="Manipulação do comportamento do usuário pelo controle de dados na internet"></option>
                <option value="Desafios para a formação educacional de surdos no Brasil"></option>
                <option value="Caminhos para combater a intolerância religiosa no Brasil"></option>
                <option value="A persistência da violência contra a mulher na sociedade brasileira"></option>
                <option value="Publicidade infantil em questão no Brasil"></option>
              </datalist>
              
              <div id="tema-livre-div" style="display: none; margin-top: 15px;">
                <label for="tema_livre_input">Digite seu Tema</label>
                <input type="text" name="tema_livre_input" id="tema_livre_input" placeholder="Digite o tema da sua redação">
              </div>

              <label for="name">Título</label>
              <input type="text" name="name" id="name" placeholder="Digite o título da sua redação (opcional)">
              
              <label for="message">Sua Redação</label>
              <textarea name="message" id="message" placeholder="Escreva aqui o texto completo da sua redação para correção..." required></textarea>
              
              <button type="submit">Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </main>
    <script>
      const hamburgerMenu = document.querySelector('.hamburger-menu');
      const bigWrapper = document.querySelector('.big-wrapper');

      hamburgerMenu.addEventListener('click', () => {
        bigWrapper.classList.toggle('active');
      });

      const temaInput = document.getElementById('exampleDataList');
      const temaLivreDiv = document.getElementById('tema-livre-div');
      const temaLivreInput = document.getElementById('tema_livre_input');

      temaInput.addEventListener('input', function() {
          if (temaInput.value === 'Tema Livre') {
              temaLivreDiv.style.display = 'block';
              temaLivreInput.required = true;
          } else {
              temaLivreDiv.style.display = 'none';
              temaLivreInput.required = false;
          }
      });
    </script>
  </body>
</html>