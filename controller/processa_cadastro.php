<?php

session_start(); // Inicia a sessão para armazenar mensagens de sucesso/erro

require_once '../model/conexao.php'; 
require_once 'validacoes.php'; 

// O script deve ser acessado apenas via POST do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['cadastroFeito'])) { // Verifica se o botão de submit foi pressionado
        $dados = array_map('trim', $dados);

        $validacao = validarDados($dados); // Chama a função de validação

        if (empty($validacao)) {
            // Remove caracteres do CPF e telefone para salvar no banco
            $cpfLimpo = preg_replace('/\D/', '', $dados['cpf']);
            $telefoneLimpo = preg_replace('/\D/', '', $dados['telefone']);

            // Hash da senha
            $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);

            try {
                // Prepara e executa a inserção no banco de dados
                $sql = "INSERT INTO Usuario_e_livros.tabelaEscritores (nome, cpf, email, senha, telefone)
                        VALUES (:nome, :cpf, :email, :senha, :telefone)";
                $cadUsuario = $pdo->prepare($sql);
                $cadUsuario->execute([
                    ':nome' => $dados['nome'],
                    ':cpf' => $cpfLimpo,
                    ':email' => $dados['email'],
                    ':senha' => $senha_hash,
                    ':telefone' => $telefoneLimpo
                ]);

                if ($cadUsuario->rowCount()) {
                    $_SESSION['cadastro_sucesso'] = "Usuário cadastrado com sucesso! Faça login para continuar.";
                    header('Location: ../view/login.php'); // Redireciona para a página de login
                    exit;
                } else {
                    $_SESSION['cadastro_erro'] = "Erro ao cadastrar usuário! Tente novamente.";
                    // Armazena os dados preenchidos para não perdê-los no formulário
                    $_SESSION['dados_formulario'] = $dados; 
                    header('Location: ../view/cadastrar.php'); // Volta para o cadastro com erro
                    exit;
                }
            } catch (PDOException $e) {
                $_SESSION['cadastro_erro'] = "Ocorreu um erro no servidor: " . $e->getMessage();
                $_SESSION['dados_formulario'] = $dados; 
                error_log("Erro de PDO no cadastro: " . $e->getMessage()); // Log para depuração
                header('Location: ../view/cadastrar.php');
                exit;
            }
        } else {
            // Armazena os erros de validação e os dados preenchidos na sessão
            $_SESSION['cadastro_erro_validacao'] = $validacao;
            $_SESSION['dados_formulario'] = $dados; 
            header('Location: ../view/cadastrar.php'); // Volta para o cadastro com erros
            exit;
        }
    }
} else {
    // Se a página for acessada diretamente sem POST, redireciona para o formulário
    header('Location: ../view/cadastrar.php');
    exit;
}
?>