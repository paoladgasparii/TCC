<?php
require_once '../verificar_sessao.php';
require_once '../config.php';
verificar_admin();

$stmt = $pdo->query("SELECT * FROM redacoes ORDER BY data_envio DESC");
$redacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Redações</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Redações Enviadas</h2>
        <table>
            <thead>
                <tr>
                    <th>Aluno</th>
                    <th>Título</th>
                    <th>Tema</th>
                    <th>Data de Envio</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($redacoes)): ?>
                    <tr>
                        <td colspan="6">Nenhuma redação encontrada.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($redacoes as $redacao): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($redacao['aluno_nome']); ?></td>
                            <td><?php echo htmlspecialchars($redacao['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($redacao['tema']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($redacao['data_envio'])); ?></td>
                            <td>
                                <span class="status-<?php echo $redacao['status']; ?>">
                                    <?php echo ucfirst($redacao['status']); ?>
                                </span>
                            </td>
                            <td>
                                <div class="actions-cell">
                                <a href="ver_redacao.php?id=<?php echo $redacao['id']; ?>" class="btn">Ver</a>
                                <?php if ($redacao['status'] === 'pendente'): ?>
                                    <a href="corrigir_redacao.php?id=<?php echo $redacao['id']; ?>" class="btn btn-corrigir">Corrigir</a>
                                <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>