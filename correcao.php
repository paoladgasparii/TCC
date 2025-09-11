<?php
session_start();

// Inicializar array de redações na sessão se não existir
if (!isset($_SESSION['redacoes'])) {
    $_SESSION['redacoes'] = [];
}

$message = '';
$messageType = '';

// Processar formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tema = trim($_POST['list'] ?? '');
    $titulo = trim($_POST['name'] ?? '');
    $redacao = trim($_POST['message'] ?? '');
    
    // Validação
    if (empty($tema) || empty($redacao)) {
        $message = 'Por favor, preencha o tema e o texto da redação.';
        $messageType = 'error';
    } else {
        // Criar nova redação
        $novaRedacao = [
            'id' => uniqid(),
            'tema' => $tema,
            'titulo' => !empty($titulo) ? $titulo : 'Sem título',
            'texto' => $redacao,
            'data_envio' => date('Y-m-d H:i:s'),
            'status' => 'pendente',

            'posicao_fila' => count($_SESSION['redacoes']) + 1,
            'notas' => [
                'c1' => 0,
                'c2' => 0,
                'c3' => 0,
                'c4' => 0,
                'c5' => 0
            ],
            'nota_final' => 0,
            'comentarios' => '',
            'pontos_fortes' => '',
            'pontos_melhoria' => '',
            'posicao_fila' => count($_SESSION['redacoes']) + 1

        ];
        
        // Adicionar à sessão
        $_SESSION['redacoes'][] = $novaRedacao;
        
        $message = 'Redação enviada com sucesso! Você pode acompanhar o status na aba Histórico.';
        $messageType = 'success';
        
        // Limpar formulário após envio bem-sucedido
        $_POST = [];
    }
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
    <title>Corrija Aí - Correção</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="stylecorrecao.css" />
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

            <form action="correcao.php" method="POST" data-form>
              <label for="list">
                 Tema
              </label>
              <input 
                class="form-control" 
                list="datalistOptions" 
                id="exampleDataList" 
                placeholder=" Escolha o tema da sua redação" 
                name="list" 
                value="<?php echo htmlspecialchars($_POST['list'] ?? ''); ?>"
                required
              >
              <datalist id="datalistOptions">
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
              
              <label for="name">
                Título
              </label>
              <input 
                type="text" 
                name="name" 
                id="name"
                placeholder="Digite o título da sua redação (opcional)"
                value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
              >
              
              <label for="message">
                Sua Redação
              </label>
              <textarea 
                name="message" 
                id="message"
                placeholder="Escreva aqui o texto completo da sua redação para correção..." 
                required
              ><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
              
              <button type="submit" data-button>Enviar
              </button>
            </form>

            <!-- Estatísticas de redações enviadas -->
            <?php if (!empty($_SESSION['redacoes'])): ?>
            <div class="stats-container">
              <h3>Suas Estatísticas</h3>
              <div class="stats-grid">
                <div class="stat-item">
                  <span class="stat-number"><?php echo count($_SESSION['redacoes']); ?></span>
                  <span class="stat-label">Redações Enviadas</span>
                </div>
                <div class="stat-item">
                  <span class="stat-number"><?php echo count(array_filter($_SESSION['redacoes'], function($r) { return $r['status'] === 'pendente'; })); ?></span>
                  <span class="stat-label">Pendentes</span>
                </div>
                <div class="stat-item">
                  <span class="stat-number"><?php echo count(array_filter($_SESSION['redacoes'], function($r) { return $r['status'] === 'corrigida'; })); ?></span>
                  <span class="stat-label">Corrigidas</span>
                </div>
              </div>
              <a href="historico.php" class="btn view-history-btn">Ver Histórico Completo</a>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </main>

    <script>
      // Menu hamburger
      const hamburgerMenu = document.querySelector('.hamburger-menu');
      const bigWrapper = document.querySelector('.big-wrapper');

      hamburgerMenu.addEventListener('click', () => {
        bigWrapper.classList.toggle('active');
      });

      // Contador de caracteres para a redação
      const textarea = document.getElementById('message');
      const maxChars = 3000; // Limite aproximado para redação ENEM
      const maxChars = 2000; // Limite aproximado para redação ENEM

      function createCharCounter() {
        const counter = document.createElement('div');
        counter.className = 'char-counter';
        counter.innerHTML = `<span id="current-chars">0</span>/${maxChars} caracteres`;
        textarea.parentNode.insertBefore(counter, textarea.nextSibling);
        
        textarea.addEventListener('input', function() {
          const currentLength = this.value.length;
          document.getElementById('current-chars').textContent = currentLength;
          
          if (currentLength > maxChars * 0.9) {
            counter.style.color = '#e74c3c';
          } else if (currentLength > maxChars * 0.7) {
            counter.style.color = '#f39c12';
          } else {
            counter.style.color = '#535353';
          }
        });
      }

      // Adicionar contador quando página carregar
      document.addEventListener('DOMContentLoaded', createCharCounter);

      // Auto-save no localStorage a cada 30 segundos
      let autoSaveInterval;
      
      function startAutoSave() {
        autoSaveInterval = setInterval(() => {
          const formData = {
            tema: document.getElementById('exampleDataList').value,
            titulo: document.getElementById('name').value,
            texto: document.getElementById('message').value,
            timestamp: Date.now()
          };
          
          if (formData.texto.trim().length > 50) { // Só salvar se tiver conteúdo significativo
            localStorage.setItem('redacao_rascunho', JSON.stringify(formData));
            showAutoSaveIndicator();
          }
        }, 30000); // 30 segundos
      }

      function loadAutoSave() {
        const savedData = localStorage.getItem('redacao_rascunho');
        if (savedData) {
          try {
            const data = JSON.parse(savedData);
            const isRecent = (Date.now() - data.timestamp) < 24 * 60 * 60 * 1000; // 24 horas
            
            if (isRecent && confirm('Encontramos um rascunho salvo automaticamente. Deseja carregá-lo?')) {
              document.getElementById('exampleDataList').value = data.tema || '';
              document.getElementById('name').value = data.titulo || '';
              document.getElementById('message').value = data.texto || '';
              
              // Atualizar contador de caracteres
              const event = new Event('input');
              textarea.dispatchEvent(event);
            }
          } catch (e) {
            console.log('Erro ao carregar rascunho:', e);
          }
        }
      }

      function showAutoSaveIndicator() {
        const indicator = document.createElement('div');
        indicator.className = 'auto-save-indicator';
        indicator.textContent = '✓ Rascunho salvo automaticamente';
        document.body.appendChild(indicator);
        
        setTimeout(() => {
          indicator.remove();
        }, 2000);
      }

      // Inicializar auto-save
      document.addEventListener('DOMContentLoaded', () => {
        loadAutoSave();
        startAutoSave();
      });

      // Limpar rascunho após envio bem-sucedido
      <?php if ($messageType === 'success'): ?>
      localStorage.removeItem('redacao_rascunho');
      <?php endif; ?>
    </script>

  </body>
</html>
