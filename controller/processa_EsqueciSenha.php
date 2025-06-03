<?php
session_start();
require_once '../model/conexao.php'; // Caminho do arquivo de conexão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['reset_erro'] = "Por favor, insira um e-mail válido.";
        header('Location: ../view/esqueciSenha.php');
        exit;
    }

    try {
        // 1. Verifica se o e-mail existe na sua tabela de usuários
        // MUDANÇA AQUI: de 'usuarios' para 'tabelaEscritores'
        // MUDANÇA AQUI: de 'senha_hash' para 'senha' (embora você só use 'id' e 'nome' na seleção aqui)
        $stmt = $pdo->prepare("SELECT id, nome, senha FROM tabelaEscritores WHERE email = :email"); 
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $usuario_id = $usuario['id'];
            
            $nova_senha_padrao = "123456"; 
            $senha_hash = password_hash($nova_senha_padrao, PASSWORD_DEFAULT); // Hash da senha padrão

            // Atualiza a senha do usuário no banco de dados
            // MUDANÇA AQUI: de 'usuarios' para 'tabelaEscritores'
            // MUDANÇA AQUI: de 'senha_hash' para 'senha'
            $stmt_update = $pdo->prepare("UPDATE tabelaEscritores SET senha = :senha_hash WHERE id = :usuario_id"); 
            $stmt_update->execute([
                ':senha_hash' => $senha_hash,
                ':usuario_id' => $usuario_id
            ]);

            $_SESSION['reset_mensagem'] = "Sua senha foi redefinida com sucesso para: **123456**. Por favor, use esta senha para entrar e altere-a o mais rápido possível.";
            
        } else {
            $_SESSION['reset_mensagem'] = "Se o e-mail estiver cadastrado, sua senha será redefinida.";
        }

    } catch (PDOException $e) {
        $_SESSION['reset_erro'] = "Ocorreu um erro no servidor ao processar sua solicitação. Tente novamente mais tarde.";
        error_log("Erro ao redefinir senha simples (DB): " . $e->getMessage()); // Para depuração
    } finally {
        header('Location: ../view/esqueciSenha.php');
        exit;
    }
} else {
    header('Location: ../view/esqueciSenha.php');
    exit;
}
?>