<?php
require_once 'verificar_sessao.php';
verificar_login(); // Verifica se o usuário está logado
$usuario = obter_usuario_logado();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Corrija Aí - Vídeoaulas</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="./styleaulas.css" />
</head>

<body>
  <main>
    <div class="big-wrapper light">
      <img src="./img/shape.png" alt="" class="shape" />

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

          <div class="overlay"></div>

          <div class="hamburger-menu">
            <div class="bar"></div>
          </div>
        </div>
      </header>

        <div class="lessons-grid">
          
          <div class="lesson-card">
            <div class="lesson-header1">
              <div class="lesson-meta">
                <span class="lesson-duration">
                  <i class="bi bi-clock"></i> 15:30
                </span>
              </div>
              <div class="play-icon">
              <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
              <i class="bi bi-play-fill"></i>
              </div>
            </div>
            <div class="lesson-content">
              <h3 class="lesson-title">Introdução à Redação do ENEM</h3>
              <p class="lesson-description">
              Nesta aula introdutória, você vai conhecer todos os pontos essenciais da redação do ENEM. Vamos explicar como a prova funciona, o que os corretores avaliam, quais são as cinco competências exigidas e como a estrutura do texto influencia sua nota.
              </p>
              <div class="lesson-tags">
                <span class="lesson-tag">Estrutura</span>
                <span class="lesson-tag">Competências</span>
                <span class="lesson-tag">Pontuação</span>
              </div>
              <div class="lesson-footer">
                <div class="difficulty-level">                 
                </div>
                <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
                Começar
                </button>
              </div>
            </div>
          </div>

          <div class="lesson-card">
            <div class="lesson-header2">
              <div class="lesson-meta">
                <span class="lesson-duration">
                  <i class="bi bi-clock"></i> 18:45
                </span>
              </div>
              <div class="play-icon">
              <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
              <i class="bi bi-play-fill"></i>
              </div>
            </div>
            <div class="lesson-content">
              <h3 class="lesson-title">Estrutura da Dissertação-Argumentativa</h3>
              <p class="lesson-description">
              Entenda como construir uma dissertação-argumentativa bem estruturada, no formato exigido pelo ENEM. Você vai aprender a apresentar sua tese, organizar os parágrafos e desenvolver argumentos de forma clara, lógica e coerente.
              </p>
              <div class="lesson-tags">
                <span class="lesson-tag">Tese</span>
                <span class="lesson-tag">Argumentos</span>
                <span class="lesson-tag">Organização</span>
              </div>
              <div class="lesson-footer">
                <div class="difficulty-level">
                </div>
                <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
                Começar
                </button>
              </div>
            </div>
          </div>

          <div class="lesson-card">
            <div class="lesson-header3">
              <div class="lesson-meta">
                <span class="lesson-duration">
                  <i class="bi bi-clock"></i> 22:15
                </span>
              </div>
              <div class="play-icon">
              <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
              <i class="bi bi-play-fill"></i>
              </div>
            </div>
            <div class="lesson-content">
              <h3 class="lesson-title">Repertório Sociocultural na Redação</h3>
              <p class="lesson-description">
              Aprenda como usar referências socioculturais para fortalecer seus argumentos. Nesta aula, você verá como escolher repertórios relevantes, como aplicá-los corretamente e como evitar o uso superficial.
              </p>
              <div class="lesson-tags">
                <span class="lesson-tag">Tipos</span>
                <span class="lesson-tag">Aplicação</span>
                <span class="lesson-tag">Pertinência</span>
              </div>
              <div class="lesson-footer">
                <div class="difficulty-level">
                </div>
                <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
                Começar
                </button>
              </div>
            </div>
          </div>

          <div class="lesson-card">
            <div class="lesson-header4">
              <div class="lesson-meta">
                <span class="lesson-duration">
                  <i class="bi bi-clock"></i> 16:30
                </span>
              </div>
              <div class="play-icon">
              <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
              <i class="bi bi-play-fill"></i>
              </div>
            </div>
            <div class="lesson-content">
              <h3 class="lesson-title">Proposta de Intervenção</h3>
              <p class="lesson-description">
              Descubra como elaborar uma proposta de intervenção completa e alinhada ao tema da redação. Vamos te ensinar a estruturar soluções viáveis, detalhadas e compatíveis com os direitos humanos, como exige a competência 5 do ENEM.
              <div class="lesson-tags">
                <span class="lesson-tag">Intervenção</span>
                <span class="lesson-tag">Soluções</span>
                <span class="lesson-tag">Detalhamento</span>
              </div>
              <div class="lesson-footer">
                <div class="difficulty-level">
                </div>
                <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
                Começar
                </button>
              </div>
            </div>
          </div>

          <div class="lesson-card">
            <div class="lesson-header5">
              <div class="lesson-meta">
                <span class="lesson-duration">
                  <i class="bi bi-clock"></i> 19:20
                </span>
              </div>
              <div class="play-icon">
              <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
              <i class="bi bi-play-fill"></i>
              </div>
            </div>
            <div class="lesson-content">
              <h3 class="lesson-title">Coesão e Coerência: Conectando Ideias</h3>
              <p class="lesson-description">
              Saiba como garantir que seu texto tenha fluidez e sentido do começo ao fim. Vamos mostrar como usar conectivos corretamente, manter a progressão lógica dos parágrafos e evitar repetições ou rupturas que atrapalham a leitura.
              <div class="lesson-tags">
                <span class="lesson-tag">Conectivos</span>
                <span class="lesson-tag">Coesão</span>
                <span class="lesson-tag">Fluidez</span>
              </div>
              <div class="lesson-footer">
                <div class="difficulty-level">
              </div>
              <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
                Começar
                </button>
              </div>
            </div>
          </div>

          <div class="lesson-card">
            <div class="lesson-header6">
              <div class="lesson-meta">
                <span class="lesson-duration">
                  <i class="bi bi-clock"></i> 21:10
                </span>
              </div>
              <div class="play-icon">
              <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
              <i class="bi bi-play-fill"></i>
              </div>
            </div>
            <div class="lesson-content">
              <h3 class="lesson-title">Redação Nota 1000</h3>
              <p class="lesson-description">
              Nesta aula, você vai ver como uma redação do ENEM é construída na prática. Você vai acompanhar, passo a passo, desde a leitura e interpretação do tema, até a elaboração da tese, desenvolvimento dos argumentos e proposta de intervenção. Ideal para visualizar na prática tudo o que foi aprendido até aqui.
              </p>
              <div class="lesson-tags">
                <span class="lesson-tag">Análise </span>
                <span class="lesson-tag">Desenvolvimento </span>
                <span class="lesson-tag">Finalização </span>
              </div>
              <div class="lesson-footer">
                <div class="difficulty-level">
                </div>
                <button class="start-btn" onclick="window.location.href='aulas php/aula1.php'">
                Começar
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>
</body>

</html>