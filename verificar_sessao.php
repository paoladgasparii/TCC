<?php
// Arquivo para ser incluído nas páginas que precisam de autenticação
session_start();

function verificar_login() {
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header("Location: login.php");
        exit();
    }
}

function verificar_admin() {
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !$_SESSION['is_admin']) {
        header("Location: ../login.php");
        exit();
    }
}

function obter_usuario_logado() {
    if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
        // Extrai o primeiro nome do nome completo armazenado na sessão
        $primeiro_nome = explode(' ', $_SESSION['usuario_nome'])[0];

        return [
            'id' => $_SESSION['usuario_id'],
            'nome' => $primeiro_nome,
            'email' => $_SESSION['usuario_email'],
            'is_admin' => $_SESSION['is_admin']
        ];
    }
    return null;
}

function esta_logado() {
    return isset($_SESSION['logado']) && $_SESSION['logado'] === true;
}
?>