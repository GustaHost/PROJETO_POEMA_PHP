<?php
//Validações para inserir os poemas
function validarPoemas($dados) {
    $validar = [];

    $dados = [
                'nomeAutor' => filter_input(INPUT_POST, 'nomeAutor', FILTER_DEFAULT),
                'novoPoema' => filter_input(INPUT_POST, 'novoPoema', FILTER_DEFAULT),
                'cadastrarPoema' => filter_input(INPUT_POST, 'cadastrarPoema', FILTER_DEFAULT)
            ];

    if (in_array("", $dados, true)){
        $validar[] = "Existem campos em branco!";
    }

    if (isset($dados['nomeAutor']) && preg_match('/[0-9]/', $dados['nomeAutor'])) {
        $validar[] = "O nome não pode conter números.";
    }

    return $validar;
}
?>