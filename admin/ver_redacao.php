<?php
require_once '../verificar_sessao.php';
require_once '../config.php'; // Adicionado para conectar ao banco de dados
verificar_admin();

$redacao_id = $_GET['id'] ?? null;
$redacao = null;

if (!$redacao_id) {
    die("ID da redação não fornecido.");
}

// Busca a redação diretamente do banco de dados
$stmt = $pdo->prepare("SELECT * FROM redacoes WHERE id = ?");
$stmt->execute([$redacao_id]);
$redacao = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$redacao) {
    die("Redação não encontrada.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Redação</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Detalhes da Redação</h2>

        <div class="redacao-info">
            <h3><?php echo htmlspecialchars($redacao['titulo']); ?></h3>
            <p><strong>Aluno:</strong> <?php echo htmlspecialchars($redacao['aluno_nome']); ?></p>
            <p><strong>Tema:</strong> <?php echo htmlspecialchars($redacao['tema']); ?></p>
            <p><strong>Status:</strong> <span class="status-<?php echo $redacao['status']; ?>"><?php echo ucfirst($redacao['status']); ?></span></p>
            <?php if ($redacao['status'] === 'corrigida'): ?>
                <p><strong>Nota Final:</strong> <?php echo $redacao['nota_final']; ?>/1000</p>
            <?php endif; ?>
        </div>

        <?php if ($redacao['status'] === 'corrigida'): ?>
            <div class="correcao-details">
                <h4>Notas por Competência:</h4>
                <ul>
                    <li><strong>Competência 1:</strong> <?php echo $redacao['c1']; ?></li>
                    <li><strong>Competência 2:</strong> <?php echo $redacao['c2']; ?></li>
                    <li><strong>Competência 3:</strong> <?php echo $redacao['c3']; ?></li>
                    <li><strong>Competência 4:</strong> <?php echo $redacao['c4']; ?></li>
                    <li><strong>Competência 5:</strong> <?php echo $redacao['c5']; ?></li>
                </ul>

                <h4>Comentários:</h4>
                <p><?php echo nl2br(htmlspecialchars($redacao['comentarios'])); ?></p>

                <h4>Pontos Fortes:</h4>
                <p><?php echo nl2br(htmlspecialchars($redacao['pontos_fortes'])); ?></p>

                <h4>Pontos de Melhoria:</h4>
                <p><?php echo nl2br(htmlspecialchars($redacao['pontos_melhoria'])); ?></p>
            </div>
        <?php endif; ?>

        <div class="texto-redacao">
            <h4>Texto Original:</h4>
            <p style="white-space: pre-wrap;"><?php echo htmlspecialchars($redacao['texto']); ?></p>
        </div>
        <br>
        <a href="redacoes.php" class="btn">Voltar</a>
    </div>
</body>
</html>