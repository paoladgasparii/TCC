<?php
require_once '../verificar_sessao.php';
verificar_admin();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Bem-vindo ao Painel do Administrador</h1>
        <p>Selecione uma opção no menu acima para gerenciar o conteúdo do site.</p>
    </div>
</body>
</html>