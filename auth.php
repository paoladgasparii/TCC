<?php
session_start();
require_once 'config.php';

// Função para validar email
function validar_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Função para validar senha (mínimo 6 caracteres)
function validar_senha($senha) {
    return strlen($senha) >= 6;
}

// Processar formulário de cadastro
if ($_POST['action'] == 'cadastro') {
    $nome = trim($_POST['name']);
    $email = trim($_POST['email']);
    $senha = $_POST['password'];
    
    $erros = [];
    
    // Validações
    if (empty($nome)) {
        $erros[] = "Nome é obrigatório";
    }
    
    if (empty($email) || !validar_email($email)) {
        $erros[] = "E-mail válido é obrigatório";
    }
    
    if (empty($senha) || !validar_senha($senha)) {
        $erros[] = "Senha deve ter pelo menos 6 caracteres";
    }
    
    // Verificar se email já existe
    if (empty($erros)) {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $erros[] = "Este e-mail já está cadastrado";
        }
    }
    
    // Se não há erros, cadastrar usuário
    if (empty($erros)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        
        if ($stmt->execute([$nome, $email, $senha_hash])) {
            // Buscar o usuário recém-criado para fazer login automático
            $stmt = $pdo->prepare("SELECT id, nome, email FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Criar sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['logado'] = true;
            
            // Redirecionar para página inicial
            header("Location: inicio.php");
            exit();
        } else {
            $erros[] = "Erro ao cadastrar usuário. Tente novamente.";
        }
    }
    
    // Se houver erros, armazenar na sessão e redirecionar de volta
    if (!empty($erros)) {
        $_SESSION['erros'] = $erros;
        header("Location: login.php");
        exit();
    }
}

// Processar formulário de login
if ($_POST['action'] == 'login') {
    $email = trim($_POST['email']);
    $senha = $_POST['password'];
    
    $erros = [];
    
    // Validações básicas
    if (empty($email) || !validar_email($email)) {
        $erros[] = "E-mail válido é obrigatório";
    }
    
    if (empty($senha)) {
        $erros[] = "Senha é obrigatória";
    }
    
    // Verificar credenciais
    if (empty($erros)) {
        $stmt = $pdo->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['logado'] = true;
            
            // Redirecionar para página inicial
            header("Location: inicio.php");
            exit();
        } else {
            $erros[] = "E-mail ou senha incorretos";
        }
    }
    
    // Se houver erros, armazenar na sessão e redirecionar de volta
    if (!empty($erros)) {
        $_SESSION['erros'] = $erros;
        header("Location: login.php");
        exit();
    }
}

// Se chegou até aqui sem POST válido, redirecionar para login
header("Location: login.php");
exit();
?>