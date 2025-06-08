<?php

session_start(); 

require_once '../model/conexao.php'; 
require_once 'validacoes.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['cadastroFeito'])) { 
        $dados = array_map('trim', $dados);

        $validacao = validarDados($dados); 

        if (empty($validacao)) {
           
            $cpfLimpo = preg_replace('/\D/', '', $dados['cpf']);
            $telefoneLimpo = preg_replace('/\D/', '', $dados['telefone']);

           
            $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);

            try {
                
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
                    header('Location: ../view/login.php'); 
                    exit;
                } else {
                    $_SESSION['cadastro_erro'] = "Erro ao cadastrar usuário! Tente novamente.";
                    
                    $_SESSION['dados_formulario'] = $dados; 
                    header('Location: ../view/cadastrar.php'); 
                    exit;
                }
            } catch (PDOException $e) {
                $_SESSION['cadastro_erro'] = "Ocorreu um erro no servidor: " . $e->getMessage();
                $_SESSION['dados_formulario'] = $dados; 
                error_log("Erro de PDO no cadastro: " . $e->getMessage()); 
                header('Location: ../view/cadastrar.php');
                exit;
            }
        } else {
           
            $_SESSION['cadastro_erro_validacao'] = $validacao;
            $_SESSION['dados_formulario'] = $dados; 
            header('Location: ../view/cadastrar.php'); 
            exit;
        }
    }
} else {
    
    header('Location: ../view/cadastrar.php');
    exit;
}
?>