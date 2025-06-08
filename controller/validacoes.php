<?php

function validarDados($dados) {
    $validacao = [];

    
    if (empty($dados['nome'])) {
        $validacao[] = "O campo Nome é obrigatório.";
    }
    if (empty($dados['cpf'])) {
        $validacao[] = "O campo CPF é obrigatório.";
    }
    if (empty($dados['email'])) {
        $validacao[] = "O campo E-mail é obrigatório.";
    }
    if (empty($dados['senha'])) {
        $validacao[] = "O campo Senha é obrigatório.";
    }
    if (empty($dados['telefone'])) {
        $validacao[] = "O campo Telefone é obrigatório.";
    }


    if (preg_match('/[0-9]/', $dados['nome'])) {
        $validacao[] = "O nome não pode conter números.";
    }

    if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $dados['cpf'])) {
        $validacao[] = "CPF inválido. Formato esperado: 000.000.000-00";
    }

    if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $validacao[] = "E-mail inválido.";
    }

    if (!preg_match('/^\(\d{2}\) \d{5}-\d{4}$/', $dados['telefone'])) {
        $validacao[] = "Telefone inválido. Formato esperado: (00) 00000-0000";
    }

    if (strlen($dados['senha']) < 6) { // Exemplo de validação de tamanho de senha
        $validacao[] = "A senha deve ter no mínimo 6 caracteres.";
    }

    return $validacao;
}
?>