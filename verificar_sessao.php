<?php
// Arquivo para ser incluído nas páginas que precisam de autenticação
session_start();

function verificar_login() {
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header("Location: login.php");
        exit();
    }
}

function obter_usuario_logado() {
    if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
        return [
            'id' => $_SESSION['usuario_id'],
            'nome' => $_SESSION['usuario_nome'],
            'email' => $_SESSION['usuario_email']
        ];
    }
    return null;
}

function esta_logado() {
    return isset($_SESSION['logado']) && $_SESSION['logado'] === true;
}
?>