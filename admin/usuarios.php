<?php
require_once '../verificar_sessao.php';
require_once '../config.php';
verificar_admin();

$admin_logado = obter_usuario_logado();

$stmt = $pdo->query("SELECT id, nome, email, data_cadastro, is_admin FROM usuarios ORDER BY data_cadastro DESC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        /* Estilos para que os formulários pareçam botões */
        .actions-cell form {
            display: inline-block;
            margin: 0;
        }
        .actions-cell .btn-form {
            background: none;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Gerenciamento de Usuários</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Data de Cadastro</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($usuarios)): ?>
                    <tr>
                        <td colspan="5">Nenhum usuário encontrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td data-label="Nome"><?php echo htmlspecialchars($usuario['nome']); ?></td>
                            <td data-label="E-mail"><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td data-label="Data de Cadastro"><?php echo date('d/m/Y', strtotime($usuario['data_cadastro'])); ?></td>
                            <td data-label="Tipo">
                                <span class="status-badge <?php echo $usuario['is_admin'] ? 'status-admin' : 'status-aluno'; ?>">
                                    <?php echo $usuario['is_admin'] ? 'Admin' : 'Aluno'; ?>
                                </span>
                            </td>
                            <td data-label="Ações">
                                <div class="actions-cell">
                                    <form action="editar_usuario.php" method="GET" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                        <button type="submit" class="btn btn-sm"><i class="bi bi-pencil-square"></i> Editar</button>
                                    </form>
                                    
                                    <?php if ($usuario['id'] != $admin_logado['id']): ?>
                                        <form action="excluir_usuario.php" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.');">
                                            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Excluir</button>
                                        </form>
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