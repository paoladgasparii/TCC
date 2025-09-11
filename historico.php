<?php
session_start();

// Inicializar array de redações na sessão se não existir
if (!isset($_SESSION['redacoes'])) {
    $_SESSION['redacoes'] = [];
}

$redacoes = $_SESSION['redacoes'];

// Processar ações POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $redacao_id = $_POST['redacao_id'] ?? '';
    
    // Simular correção
    if (isset($_POST['simular_correcao']) && !empty($redacao_id)) {
        foreach ($_SESSION['redacoes'] as &$redacao) {
            if ($redacao['id'] === $redacao_id) {
                // Gerar notas aleatórias realísticas
                $redacao['notas'] = [
                    'c1' => rand(120, 200),
                    'c2' => rand(120, 200),
                    'c3' => rand(100, 200),
                    'c4' => rand(120, 200),
                    'c5' => rand(80, 200)
                ];
                
                $redacao['nota_final'] = array_sum($redacao['notas']);
                $redacao['status'] = 'corrigida';
                
                // Comentários baseados na nota
                if ($redacao['nota_final'] >= 900) {
                    $redacao['comentarios'] = 'Excelente redação! Demonstra domínio das competências avaliadas.';
                    $redacao['pontos_fortes'] = 'Argumentação consistente, estrutura bem organizada, domínio da norma culta.';
                    $redacao['pontos_melhoria'] = 'Continue praticando para manter este nível de excelência.';
                } elseif ($redacao['nota_final'] >= 700) {
                    $redacao['comentarios'] = 'Boa redação com argumentos válidos e estrutura adequada.';
                    $redacao['pontos_fortes'] = 'Boa compreensão do tema, argumentos relevantes.';
                    $redacao['pontos_melhoria'] = 'Aprimorar conectivos e diversificar repertório sociocultural.';
                } else {
                    $redacao['comentarios'] = 'Redação com potencial, mas precisa de melhorias.';
                    $redacao['pontos_fortes'] = 'Compreensão básica do tema proposto.';
                    $redacao['pontos_melhoria'] = 'Fortalecer argumentação, melhorar estrutura textual e domínio da norma culta.';
                }
                
                break;
            }
        }
        
        // Atualizar array de redações
        $redacoes = $_SESSION['redacoes'];
        
        // Redirect para evitar reenvio
        header('Location: historico.php');
        exit;
    }
    
    // Cancelar correção
    if (isset($_POST['cancelar_correcao']) && !empty($redacao_id)) {
        foreach ($_SESSION['redacoes'] as $key => $redacao) {
            if ($redacao['id'] === $redacao_id) {
                unset($_SESSION['redacoes'][$key]);
                break;
            }
        }
        
        // Reindexar array
        $_SESSION['redacoes'] = array_values($_SESSION['redacoes']);
        $redacoes = $_SESSION['redacoes'];
        
        // Redirect para evitar reenvio
        header('Location: historico.php');
        exit;
    }
}

// Função para formatar data
function formatarData($data) {
    $timestamp = strtotime($data);
    return date('d/m/Y H:i', $timestamp);
}

// Função para converter tema em slug
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
        'Publicidade infantil em questão no Brasil' => 'publicidade-infantil'
    ];
    
    return $map[$tema] ?? 'outro-tema';
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
              <option value="doencas-mentais">Doenças Mentais</option>
              <option value="acesso-cinema">Acesso ao Cinema</option>
              <option value="controle-dados">Controle de Dados</option>
              <option value="educacao-surdos">Educação de Surdos</option>
              <option value="intolerancia-religiosa">Intolerância Religiosa</option>
              <option value="violencia-mulher">Violência contra Mulher</option>
              <option value="publicidade-infantil">Publicidade Infantil</option>
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
                
                <?php if ($redacao['status'] === 'corrigida' && $redacao['nota_final'] > 0): ?>
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
                      <span>Tempo estimado: 1 a 2 semanas</span>
                    </div>
                    <div class="posicao-fila">
                      <i class="bi bi-list-ol"></i>
                      <span>Posição na fila: <?php echo $redacao['posicao_fila'] ?? ($index + 1); ?></span>
                    </div>
                  </div>
                <?php endif; ?>
                
              </div>
              
              <div class="redacao-actions">
                <?php if ($redacao['status'] === 'corrigida' && $redacao['nota_final'] > 0): ?>
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

          <!-- Estado vazio para filtros -->
          <div class="empty-state filter-empty" style="display: none;">
            <div class="empty-icon">
              <i class="bi bi-search"></i>
            </div>
            <h3>Nenhuma redação encontrada</h3>
            <p>Não há redações que correspondam aos filtros aplicados. Tente ajustar os critérios de busca.</p>
          </div>
        </div>

        <!-- Modal para visualizar redação -->
        <div id="redacaoModal" class="modal" style="display: none;">
          <div class="modal-content">
            <div class="modal-header">
              <h2 id="modalTitle">Visualizar Redação</h2>
              <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
              <div id="modalContent">
                <!-- Conteúdo será preenchido via JavaScript -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script>
    // Dados das redações para JavaScript
    const redacoes = <?php echo json_encode($redacoes); ?>;

    // Funções JavaScript para interatividade
    function viewRedacao(id) {
      const redacao = redacoes.find(r => r.id === id);
      if (!redacao) return;
      
      const modal = document.getElementById('redacaoModal');
      const modalTitle = document.getElementById('modalTitle');
      const modalContent = document.getElementById('modalContent');
      
      if (redacao.status === 'corrigida' && redacao.nota_final > 0) {
        modalTitle.textContent = 'Correção Detalhada';
        modalContent.innerHTML = `
          <div class="modal-redacao">
            <h3>${redacao.titulo}</h3>
            <p><strong>Tema:</strong> ${redacao.tema}</p>
            <p><strong>Data de envio:</strong> ${formatDate(redacao.data_envio)}</p>
            
            <div class="modal-pontuacao">
              <h4>Pontuação Final: ${redacao.nota_final}/1000</h4>
              <div class="modal-competencias">
                <div class="comp-item">C1: ${redacao.notas.c1}/200</div>
                <div class="comp-item">C2: ${redacao.notas.c2}/200</div>
                <div class="comp-item">C3: ${redacao.notas.c3}/200</div>
                <div class="comp-item">C4: ${redacao.notas.c4}/200</div>
                <div class="comp-item">C5: ${redacao.notas.c5}/200</div>
              </div>
            </div>
            
            <div class="modal-feedback">
              <h4>Comentários Gerais</h4>
              <p>${redacao.comentarios}</p>
              
              <h4>Pontos Fortes</h4>
              <p>${redacao.pontos_fortes}</p>
              
              <h4>Pontos de Melhoria</h4>
              <p>${redacao.pontos_melhoria}</p>
            </div>
            
            <div class="modal-texto">
              <h4>Texto da Redação</h4>
              <div class="texto-redacao">${redacao.texto.replace(/\n/g, '<br>')}</div>
            </div>
          </div>
        `;
      } else {
        modalTitle.textContent = 'Redação Pendente';
        modalContent.innerHTML = `
          <div class="modal-redacao">
            <h3>${redacao.titulo}</h3>
            <p><strong>Tema:</strong> ${redacao.tema}</p>
            <p><strong>Data de envio:</strong> ${formatDate(redacao.data_envio)}</p>
            <p><strong>Status:</strong> Aguardando correção</p>
            
            <div class="modal-texto">
              <h4>Texto da Redação</h4>
              <div class="texto-redacao">${redacao.texto.replace(/\n/g, '<br>')}</div>
            </div>
          </div>
        `;
      }
      
      modal.style.display = 'block';
    }

    function downloadPDF(id) {
      alert(`Função de download do PDF da redação ${id} seria implementada aqui.`);
      // Aqui você implementaria a geração e download do PDF
    }

    function closeModal() {
      document.getElementById('redacaoModal').style.display = 'none';
    }

    function formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString('pt-BR') + ' ' + date.toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
    }

    // Fechar modal clicando fora dele
    window.onclick = function(event) {
      const modal = document.getElementById('redacaoModal');
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    }

    // Sistema de filtros
    document.addEventListener('DOMContentLoaded', function() {
      const statusFilter = document.getElementById('status-filter');
      const temaFilter = document.getElementById('tema-filter');
      const searchInput = document.getElementById('search-input');
      const cards = document.querySelectorAll('.redacao-card');
      const emptyState = document.querySelector('.empty-state:not(.filter-empty)');
      const filterEmptyState = document.querySelector('.filter-empty');

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

        // Mostrar/ocultar estados vazios
        if (cards.length === 0) {
          emptyState.style.display = 'block';
          filterEmptyState.style.display = 'none';
        } else if (visibleCards === 0) {
          emptyState.style.display = 'none';
          filterEmptyState.style.display = 'block';
        } else {
          emptyState.style.display = 'none';
          filterEmptyState.style.display = 'none';
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