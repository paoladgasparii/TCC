<?php
require_once 'verificar_sessao.php';
require_once 'config.php';
verificar_login();
$usuario = obter_usuario_logado();

// Buscar redações do banco de dados para o usuário logado
$stmt = $pdo->prepare("SELECT * FROM redacoes WHERE usuario_id = ? ORDER BY data_envio DESC");
$stmt->execute([$usuario['id']]);
$redacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Função para formatar data
function formatarData($data) {
    $timestamp = strtotime($data);
    return date('d/m/Y', $timestamp);
}

// Função para converter tema em slug (usada pelos filtros)
function temaToSlug($tema) {
    $map = [
        'Desafios para a valorização da herança africana no Brasil' => 'heranca-africana',
        'Desafios para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil' => 'trabalho-cuidado',
        'Desafios para a valorização de comunidades e povos tradicionais no Brasil' => 'povos-tradicionais',
        'Invisibilidade e registro civil: garantia de acesso à cidadania no Brasil' => 'registro-civil',
        'O estigma associado às doenças mentais na sociedade brasileira' => 'doencas-mentais',
        'Democratização do acesso ao cinema no Brasil' => 'acesso-cinema',
        'Manipulação do comportamento do usuário pelo controle de dados na internet' => 'controle-dados',
        'Desafios para a formação educacional de surdos no Brasil' => 'educacao-surdos',
        'Caminhos para combater a intolerância religiosa no Brasil' => 'intolerancia-religiosa',
        'A persistência da violência contra a mulher na sociedade brasileira' => 'violencia-mulher',
        'Publicidade infantil em questão no Brasil' => 'publicidade-infantil',
        'Tema Livre' => 'tema-livre'
    ];
    
    if (isset($map[$tema])) {
        return $map[$tema];
    }
    
    return 'tema-livre';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Corrija Aí - Histórico</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./stylehistorico.css" />
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

      <div class="main-content">
        <div class="hero-section">
          <h1 class="hero-title">Histórico de Redações</h1>
          <p class="hero-subtitle">Acompanhe todas as suas redações enviadas para correção</p>
        </div>

        <div class="redacoes-list">
          
          <?php if (empty($redacoes)): ?>
            <div class="empty-state">
              <div class="empty-icon"><i class="bi bi-file-text"></i></div>
              <h3>Nenhuma redação encontrada</h3>
              <p>Você ainda não enviou nenhuma redação para correção. Comece agora!</p>
              <a href="correcao.php" class="btn">Enviar primeira redação</a>
            </div>
          <?php else: ?>
            <?php foreach ($redacoes as $redacao): ?>
            <div class="redacao-card status-<?php echo $redacao['status']; ?>" 
                 data-tema="<?php echo temaToSlug($redacao['tema']); ?>">
              
              <div class="redacao-header">
                <div class="redacao-info">
                  <h3 class="redacao-titulo"><?php echo htmlspecialchars($redacao['titulo']); ?></h3>
                  <p class="redacao-tema"><?php echo htmlspecialchars($redacao['tema']); ?></p>
                  <span class="redacao-data">
                    <i class="bi bi-calendar3"></i> Enviada em <?php echo formatarData($redacao['data_envio']); ?>
                  </span>
                </div>
                <div class="status-badge status-<?php echo $redacao['status']; ?>">
                  <?php if ($redacao['status'] === 'corrigida'): ?>
                    <i class="bi bi-check-circle-fill"></i> Corrigida
                  <?php else: ?>
                    <i class="bi bi-clock"></i> Pendente
                  <?php endif; ?>
                </div>
              </div>
              
              <?php if ($redacao['status'] === 'corrigida'): ?>
                <div class="pontuacao-geral">
                  <div class="nota-final">
                    <span class="nota-numero"><?php echo $redacao['nota_final']; ?></span>
                    <span class="nota-total">/1000</span>
                  </div>
                </div>
              <?php endif; ?>
              
              <div class="redacao-actions">
                  <button class="action-btn view-btn" onclick="viewRedacao('<?php echo $redacao['id']; ?>')">
                    <i class="bi bi-eye"></i> 
                    <?php echo $redacao['status'] === 'corrigida' ? 'Ver Correção' : 'Ver Redação'; ?>
                  </button>
              </div>
            </div>
            <?php endforeach; ?>
          <?php endif; ?>

        </div>
      </div>

      <div id="redacaoModal" class="modal" style="display: none;">
        <div class="modal-content">
          <div class="modal-header">
            <h2 id="modalTitle"></h2>
            <span class="close" onclick="closeModal()">&times;</span>
          </div>
          <div class="modal-body">
            <div id="modalContent"></div>
          </div>
        </div>
      </div>

    </div>
  </main>

  <script>
    const redacoes = <?php echo json_encode($redacoes); ?>;

    function viewRedacao(id) {
        const redacao = redacoes.find(r => r.id === id);
        if (!redacao) return;

        const modal = document.getElementById('redacaoModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');
        
        let contentHTML = `
            <div class="modal-redacao">
                <h3>${redacao.titulo}</h3>
                <p><strong>Tema:</strong> ${redacao.tema}</p>
                <p><strong>Data de envio:</strong> ${new Date(redacao.data_envio).toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric', timeZone: 'UTC' })}</p>
        `;

        if (redacao.status === 'corrigida') {
            modalTitle.textContent = 'Correção Detalhada';
            contentHTML += `
                <div class="modal-pontuacao">
                    <h4>Pontuação Final: ${redacao.nota_final}/1000</h4>
                    <div class="modal-competencias">
                        <div class="comp-item">C1: ${redacao.c1}/200</div>
                        <div class="comp-item">C2: ${redacao.c2}/200</div>
                        <div class="comp-item">C3: ${redacao.c3}/200</div>
                        <div class="comp-item">C4: ${redacao.c4}/200</div>
                        <div class="comp-item">C5: ${redacao.c5}/200</div>
                    </div>
                </div>
                
                <div class="modal-feedback">
                    <h4>Comentários Gerais</h4>
                    <p>${redacao.comentarios || 'Nenhum comentário.'}</p>
                    
                    <h4>Pontos Fortes</h4>
                    <p>${redacao.pontos_fortes || 'Nenhum ponto forte destacado.'}</p>
                    
                    <h4>Pontos de Melhoria</h4>
                    <p>${redacao.pontos_melhoria || 'Nenhum ponto de melhoria destacado.'}</p>
                </div>
            `;
        } else {
            modalTitle.textContent = 'Redação Pendente';
            contentHTML += `<p><strong>Status:</strong> Aguardando correção</p>`;
        }
        
        contentHTML += `
            <div class="modal-texto">
                <h4>Texto da Redação</h4>
                <div class="texto-redacao">${redacao.texto.replace(/\n/g, '<br>')}</div>
            </div>
          </div>
        `;
      
        modalContent.innerHTML = contentHTML;
        modal.style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('redacaoModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('redacaoModal');
        if (event.target == modal) {
            closeModal();
        }
    }
    
    // Menu hamburger
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const bigWrapper = document.querySelector('.big-wrapper');

    hamburgerMenu.addEventListener('click', () => {
      bigWrapper.classList.toggle('active');
    });
  </script>
</body>
</html>