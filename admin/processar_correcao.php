<?php
require_once '../verificar_sessao.php';
require_once '../config.php';
verificar_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $redacao_id = $_POST['redacao_id'];
    $notas = $_POST['notas'];
    $nota_final = array_sum($notas);
    $comentarios = $_POST['comentarios'];
    $pontos_fortes = $_POST['pontos_fortes'];
    $pontos_melhoria = $_POST['pontos_melhoria'];

    $stmt = $pdo->prepare(
        "UPDATE redacoes SET 
         c1 = ?, c2 = ?, c3 = ?, c4 = ?, c5 = ?, 
         nota_final = ?, comentarios = ?, pontos_fortes = ?, pontos_melhoria = ?, status = 'corrigida'
         WHERE id = ?"
    );
    
    $stmt->execute([
        $notas['c1'], $notas['c2'], $notas['c3'], $notas['c4'], $notas['c5'],
        $nota_final, $comentarios, $pontos_fortes, $pontos_melhoria, $redacao_id
    ]);

    header('Location: redacoes.php');
    exit;
}