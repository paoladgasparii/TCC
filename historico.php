<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Corrija Aí - Histórico</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
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

        <!-- Filtros -->
        <div class="filters-section">
          <div class="filter-group">
            <label for="status-filter">Status:</label>
            <select id="status-filter" class="filter-select">
              <option value="todos">Todos</option>
              <option value="pendente">Pendente</option>
              <option value="corrigida">Corrigida</option>
            </select>
          </div>
          
          <div class="filter-group">
            <label for="tema-filter">Tema:</label>
            <select id="tema-filter" class="filter-select">
              <option value="todos">Todos os temas</option>
              <option value="heranca-africana">Herança Africana no Brasil</option>
              <option value="trabalho-cuidado">Trabalho de Cuidado da Mulher</option>
              <option value="povos-tradicionais">Povos Tradicionais</option>
              <option value="registro-civil">Registro Civil e Cidadania</option>
            </select>
          </div>
          
          <div class="search-group">
            <input type="text" id="search-input" placeholder="Buscar por título..." class="search-input">
            <i class="bi bi-search search-icon"></i>
          </div>
        </div>

        <!-- Lista de Redações -->
        <div class="redacoes-list">
          
          <?php if (empty($redacoes)): ?>
            <!-- Estado vazio quando não há redações -->
            <div class="empty-state">
              <div class="empty-icon">
                <i class="bi bi-file-text"></i>
              </div>
              <h3>Nenhuma redação encontrada</h3>
              <p>Você ainda não enviou nenhuma redação para correção. Comece agora e acompanhe seu progresso!</p>
              <a href="correcao.php" class="btn">Enviar primeira redação</a>
            </div>
          <?php else: ?>
            
            <?php foreach (array_reverse($redacoes) as $index => $redacao): ?>
            <div class="redacao-card status-<?php echo $redacao['status']; ?>" 
                 data-status="<?php echo $redacao['status']; ?>" 
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
              
              <div class="redacao-content">
                
                <?php if ($redacao['status'] === 'corrigida' && isset($redacao['nota_final'])): ?>
                  <!-- Pontuação para redações corrigidas -->
                  <div class="pontuacao-geral">
                    <div class="nota-final">
                      <span class="nota-numero"><?php echo $redacao['nota_final']; ?></span>
                      <span class="nota-total">/1000</span>
                    </div>
                    <div class="nota-texto">
                      <?php 
                        $nota = $redacao['nota_final'];
                        if ($nota >= 900) echo 'Excelente';
                        elseif ($nota >= 800) echo 'Muito Boa';
                        elseif ($nota >= 700) echo 'Boa';
                        elseif ($nota >= 600) echo 'Regular';
                        else echo 'Precisa Melhorar';
                      ?>
                    </div>
                  </div>
                  
                  <div class="competencias">
                    <?php foreach (['c1', 'c2', 'c3', 'c4', 'c5'] as $comp): ?>
                    <div class="competencia">
                      <span class="comp-label"><?php echo strtoupper($comp); ?></span>
                      <div class="comp-score">
                        <div class="score-bar">
                          <div class="score-fill" style="width: <?php echo ($redacao['notas'][$comp] / 200) * 100; ?>%"></div>
                        </div>
                        <span class="score-value"><?php echo $redacao['notas'][$comp]; ?>/200</span>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  
                <?php else: ?>
                  <!-- Info para redações pendentes -->
                  <div class="pendente-info">
                    <div class="tempo-estimado">
                      <i class="bi bi-hourglass-split"></i>
                      <span>Tempo estimado: 24-48 horas</span>
                    </div>
                    <div class="posicao-fila">
                      <i class="bi bi-list-ol"></i>
                      <span>Posição na fila: <?php echo $redacao['posicao_fila'] ?? ($index + 1); ?></span>
                    </div>
                  </div>
                <?php endif; ?>
                
              </div>
              
              <div class="redacao-actions">
                <?php if ($redacao['status'] === 'corrigida'): ?>
                  <button class="action-btn view-btn" onclick="viewRedacao('<?php echo $redacao['id']; ?>')">
                    <i class="bi bi-eye"></i> Ver Correção
                  </button>
                  <button class="action-btn download-btn" onclick="downloadPDF('<?php echo $redacao['id']; ?>')">
                    <i class="bi bi-download"></i> Download
                  </button>
                <?php else: ?>
                  <button class="action-btn view-btn" onclick="viewRedacao('<?php echo $redacao['id']; ?>')">
                    <i class="bi bi-eye"></i> Ver Redação
                  </button>
                  
                  <!-- Botão para simular correção (apenas para demonstração) -->
                  <form method="POST" style="display: inline;">
                    <input type="hidden" name="redacao_id" value="<?php echo $redacao['id']; ?>">
                    <button type="submit" name="simular_correcao" class="action-btn view-btn" 
                            style="background: #f39c12;" 
                            onclick="return confirm('Simular correção desta redação? (Apenas para demonstração)')">
                      <i class="bi bi-gear"></i> Simular Correção
                    </button>
                  </form>
                  
                  <form method="POST" style="display: inline;">
                    <input type="hidden" name="redacao_id" value="<?php echo $redacao['id']; ?>">
                    <button type="submit" name="cancelar_correcao" class="action-btn cancel-btn" 
                            onclick="return confirm('Tem certeza que deseja cancelar esta correção?')">
                      <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                  </form>
                <?php endif; ?>
              </div>
            </div>
            <?php endforeach; ?>
            
          <?php endif; ?>

        <!-- Estado vazio -->
        <div class="empty-state" style="display: none;">
          <div class="empty-icon">
            <i class="bi bi-file-text"></i>
          </div>
          <h3>Nenhuma redação encontrada</h3>
          <p>Você ainda não enviou nenhuma redação para correção ou não há resultados para os filtros aplicados.</p>
          <a href="correcao.php" class="btn">Enviar primeira redação</a>
        </div>
      </div>
    </div>
  </main>

  <script>
    // Funções JavaScript para interatividade
    function viewRedacao(id) {
      alert(`Visualizar redação ${id}`);
      // Aqui você redirecionaria para uma página de detalhes da correção
    }

    function downloadPDF(id) {
      alert(`Download da correção ${id}`);
      // Aqui você faria o download do PDF da correção
    }

    function cancelCorrection(id) {
      if (confirm('Tem certeza que deseja cancelar esta correção?')) {
        alert(`Correção ${id} cancelada`);
        // Aqui você removeria a redação da lista ou mudaria seu status
      }
    }

    // Sistema de filtros
    document.addEventListener('DOMContentLoaded', function() {
      const statusFilter = document.getElementById('status-filter');
      const temaFilter = document.getElementById('tema-filter');
      const searchInput = document.getElementById('search-input');
      const cards = document.querySelectorAll('.redacao-card');
      const emptyState = document.querySelector('.empty-state');

      function applyFilters() {
        const statusValue = statusFilter.value;
        const temaValue = temaFilter.value;
        const searchValue = searchInput.value.toLowerCase();
        let visibleCards = 0;

        cards.forEach(card => {
          const cardStatus = card.dataset.status;
          const cardTema = card.dataset.tema;
          const cardTitle = card.querySelector('.redacao-titulo').textContent.toLowerCase();
          const cardTemaText = card.querySelector('.redacao-tema').textContent.toLowerCase();

          const matchesStatus = statusValue === 'todos' || cardStatus === statusValue;
          const matchesTema = temaValue === 'todos' || cardTema === temaValue;
          const matchesSearch = searchValue === '' || 
                              cardTitle.includes(searchValue) || 
                              cardTemaText.includes(searchValue);

          if (matchesStatus && matchesTema && matchesSearch) {
            card.style.display = 'block';
            visibleCards++;
          } else {
            card.style.display = 'none';
          }
        });

        // Mostrar/ocultar estado vazio
        if (visibleCards === 0) {
          emptyState.style.display = 'block';
        } else {
          emptyState.style.display = 'none';
        }
      }

      statusFilter.addEventListener('change', applyFilters);
      temaFilter.addEventListener('change', applyFilters);
      searchInput.addEventListener('input', applyFilters);
    });

    // Menu hamburger
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const bigWrapper = document.querySelector('.big-wrapper');

    hamburgerMenu.addEventListener('click', () => {
      bigWrapper.classList.toggle('active');
    });
  </script>
</body>

</html>