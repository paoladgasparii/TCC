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
    <title>Corrigir Redação</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Corrigir Redação</h2>

        <div class="redacao-info">
            <h3><?php echo htmlspecialchars($redacao['titulo']); ?></h3>
            <p><strong>Tema:</strong> <?php echo htmlspecialchars($redacao['tema']); ?></p>
            <p><strong>Texto do Aluno:</strong></p>
            <p style="white-space: pre-wrap;"><?php echo htmlspecialchars($redacao['texto']); ?></p>
        </div>

        <form action="processar_correcao.php" method="POST">
            <input type="hidden" name="redacao_id" value="<?php echo $redacao['id']; ?>">

            <div class="form-group">
                <label for="c1">Competência 1 (Domínio da norma culta):</label>
                <input type="number" name="notas[c1]" id="c1" min="0" max="200" required>
            </div>
            <div class="form-group">
                <label for="c2">Competência 2 (Compreensão do tema e estrutura):</label>
                <input type="number" name="notas[c2]" id="c2" min="0" max="200" required>
            </div>
            <div class="form-group">
                <label for="c3">Competência 3 (Seleção e organização de informações):</label>
                <input type="number" name="notas[c3]" id="c3" min="0" max="200" required>
            </div>
            <div class="form-group">
                <label for="c4">Competência 4 (Conhecimento dos mecanismos linguísticos):</label>
                <input type="number" name="notas[c4]" id="c4" min="0" max="200" required>
            </div>
            <div class="form-group">
                <label for="c5">Competência 5 (Proposta de intervenção):</label>
                <input type="number" name="notas[c5]" id="c5" min="0" max="200" required>
            </div>

            <div class="form-group">
                <label for="comentarios">Comentários Gerais:</label>
                <textarea name="comentarios" id="comentarios" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="pontos_fortes">Pontos Fortes:</label>
                <textarea name="pontos_fortes" id="pontos_fortes" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="pontos_melhoria">Pontos de Melhoria:</label>
                <textarea name="pontos_melhoria" id="pontos_melhoria" rows="3"></textarea>
            </div>

            <button type="submit" class="btn">Salvar Correção</button>
        </form>
    </div>
</body>
</html>