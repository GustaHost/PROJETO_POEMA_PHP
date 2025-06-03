<?php
function validarDados($dados) {
    $validacao = [];

    if (in_array("", $dados)) {
        $validacao[] = "Existem campos em branco!";
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

    return $validacao;
}
?>