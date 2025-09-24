<?php
require_once '../verificar_sessao.php';
require_once '../config.php';
verificar_admin();

// Estatísticas Gerais
$stmt = $pdo->query("SELECT COUNT(*) as total FROM redacoes");
$total_redacoes = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM redacoes WHERE status = 'pendente'");
$redacoes_pendentes = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM redacoes WHERE status = 'corrigida'");
$redacoes_corrigidas = $stmt->fetch()['total'];

// Redações Recentes (últimas 5)
$stmt = $pdo->query("SELECT * FROM redacoes ORDER BY data_envio DESC LIMIT 5");
$redacoes_recentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Estatísticas por Tema
$stmt = $pdo->query("
    SELECT tema, COUNT(*) as count 
    FROM redacoes 
    GROUP BY tema 
    ORDER BY count DESC 
    LIMIT 5
");
$temas_populares = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Média de Notas das Redações Corrigidas
$stmt = $pdo->query("
    SELECT AVG(nota_final) as media_geral,
           AVG(c1) as media_c1,
           AVG(c2) as media_c2,
           AVG(c3) as media_c3,
           AVG(c4) as media_c4,
           AVG(c5) as media_c5
    FROM redacoes 
    WHERE status = 'corrigida'
");
$medias = $stmt->fetch(PDO::FETCH_ASSOC);

// Redações por mês (últimos 6 meses)
$stmt = $pdo->query("
    SELECT 
        DATE_FORMAT(data_envio, '%Y-%m') as mes,
        COUNT(*) as total
    FROM redacoes 
    WHERE data_envio >= DATE_SUB(CURRENT_DATE, INTERVAL 6 MONTH)
    GROUP BY DATE_FORMAT(data_envio, '%Y-%m')
    ORDER BY mes ASC
");
$redacoes_por_mes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Função para converter tema em versão curta
function temaAbreviado($tema) {
    $palavras = explode(' ', $tema);
    return implode(' ', array_slice($palavras, 0, 4)) . (count($palavras) > 4 ? '...' : '');
}

// Função de formatar data CORRIGIDA
function formatarData($data) {
    return date('d/m/Y', strtotime($data));
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container">
        <div class="welcome-section">
            <h2>Painel do Administrador</h2>
            <p class="welcome-text">Bem-vindo ao painel de controle. Aqui você pode acompanhar todas as atividades do sistema.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card total-redacoes">
                <div class="stat-icon">
                    <i class="bi bi-file-text"></i>
                </div>
                <div class="stat-content">
                    <h3><?php echo number_format($total_redacoes); ?></h3>
                    <p>Total de Redações</p>
                </div>
            </div>

            <div class="stat-card pendentes">
                <div class="stat-icon">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stat-content">
                    <h3><?php echo number_format($redacoes_pendentes); ?></h3>
                    <p>Aguardando Correção</p>
                    <?php if($redacoes_pendentes > 0): ?>
                        <a href="redacoes.php" class="quick-action">Corrigir Agora</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="stat-card corrigidas">
                <div class="stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3><?php echo number_format($redacoes_corrigidas); ?></h3>
                    <p>Redações Corrigidas</p>
                    <span class="percentage">
                        <?php echo $total_redacoes > 0 ? round(($redacoes_corrigidas / $total_redacoes) * 100, 1) : 0; ?>% do total
                    </span>
                </div>
            </div>
        </div>

        <div class="quick-actions-section">
            <h3>Ações Rápidas</h3>
            <div class="quick-actions-grid">
                <a href="redacoes.php" class="action-card">
                    <i class="bi bi-list-check"></i>
                    <span>Gerenciar Redações</span>
                </a>
                <a href="redacoes.php?status=pendente" class="action-card pending">
                    <i class="bi bi-pencil-square"></i>
                    <span>Corrigir Pendentes</span>
                    <?php if($redacoes_pendentes > 0): ?>
                        <span class="badge"><?php echo $redacoes_pendentes; ?></span>
                    <?php endif; ?>
                </a>
                <a href="../inicio.php" class="action-card" target="_blank">
                    <i class="bi bi-eye"></i>
                    <span>Ver Site</span>
                </a>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card recent-essays">
                <div class="card-header">
                    <h3><i class="bi bi-clock"></i> Redações Recentes</h3>
                    <a href="redacoes.php" class="view-all">Ver todas</a>
                </div>
                <div class="card-content">
                    <?php if (empty($redacoes_recentes)): ?>
                        <div class="empty-state-mini">
                            <i class="bi bi-inbox"></i>
                            <p>Nenhuma redação encontrada</p>
                        </div>
                    <?php else: ?>
                        <div class="recent-list">
                            <?php foreach ($redacoes_recentes as $redacao): ?>
                                <div class="recent-item">
                                    <div class="recent-info">
                                        <h4><?php echo htmlspecialchars($redacao['titulo'] ?: 'Sem título'); ?></h4>
                                        <p class="author">Por: <?php echo htmlspecialchars($redacao['aluno_nome']); ?></p>
                                        <p class="theme"><?php echo htmlspecialchars(temaAbreviado($redacao['tema'])); ?></p>
                                        <span class="date"><?php echo formatarData($redacao['data_envio']); ?></span>
                                    </div>
                                    <div class="recent-actions">
                                        <span class="status-badge status-<?php echo $redacao['status']; ?>">
                                            <?php echo ucfirst($redacao['status']); ?>
                                        </span>
                                        <a href="ver_redacao.php?id=<?php echo $redacao['id']; ?>" class="btn btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($redacoes_corrigidas > 0): ?>
            <div class="dashboard-card performance">
                <div class="card-header">
                    <h3><i class="bi bi-bar-chart"></i> Desempenho Geral</h3>
                </div>
                <div class="card-content">
                    <div class="performance-overview">
                        <div class="overall-score">
                            <span class="score-number"><?php echo round($medias['media_geral'] ?? 0); ?></span>
                            <span class="score-total">/1000</span>
                            <p>Média Geral</p>
                        </div>
                        
                        <div class="competencias-mini">
                            <div class="comp-mini">
                                <span class="comp-label">C1</span>
                                <span class="comp-score"><?php echo round($medias['media_c1'] ?? 0); ?></span>
                            </div>
                            <div class="comp-mini">
                                <span class="comp-label">C2</span>
                                <span class="comp-score"><?php echo round($medias['media_c2'] ?? 0); ?></span>
                            </div>
                            <div class="comp-mini">
                                <span class="comp-label">C3</span>
                                <span class="comp-score"><?php echo round($medias['media_c3'] ?? 0); ?></span>
                            </div>
                            <div class="comp-mini">
                                <span class="comp-label">C4</span>
                                <span class="comp-score"><?php echo round($medias['media_c4'] ?? 0); ?></span>
                            </div>
                            <div class="comp-mini">
                                <span class="comp-label">C5</span>
                                <span class="comp-score"><?php echo round($medias['media_c5'] ?? 0); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="dashboard-card themes">
                <div class="card-header">
                    <h3><i class="bi bi-list-stars"></i> Temas Populares</h3>
                </div>
                <div class="card-content">
                    <?php if (empty($temas_populares)): ?>
                        <div class="empty-state-mini">
                            <i class="bi bi-tag"></i>
                            <p>Nenhum tema encontrado</p>
                        </div>
                    <?php else: ?>
                        <div class="themes-list">
                            <?php foreach ($temas_populares as $tema): ?>
                                <div class="theme-item">
                                    <span class="theme-name"><?php echo htmlspecialchars(temaAbreviado($tema['tema'])); ?></span>
                                    <span class="theme-count"><?php echo $tema['count']; ?> redações</span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</body>
</html>