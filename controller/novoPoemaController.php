<?php

require_once '../model/conexao.php';
include_once('../controller/validacoesPoema.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Especificando para pegar somente dois campos
            $dados = [
                'nomeAutor' => filter_input(INPUT_POST, 'nomeAutor', FILTER_DEFAULT),
                'novoPoema' => filter_input(INPUT_POST, 'novoPoema', FILTER_DEFAULT),
                'cadastrarPoema' => filter_input(INPUT_POST, 'cadastrarPoema', FILTER_DEFAULT)
            ];

            //Buscando os dados

            if(!empty($dados['cadastrarPoema'])){
            $dados = array_map('trim', $dados);

            $_SESSION['old_nomeAutor'] = $dados['nomeAutor'];
            $_SESSION['old_novoPoema'] = $dados['novoPoema'];

            $validar = validarPoemas($dados);

            //Conexão com banco de dados
            try{
                if(empty($validar)){
                    $queryUsu = "INSERT INTO tabelaPoemas (nomeAutor, novoPoema)
                VALUES('" .$dados['nomeAutor']. "', '" .$dados['novoPoema']. "')";            
        
            $cadUsuario = $pdo->prepare($queryUsu);
            $cadUsuario->execute();

            if($cadUsuario->rowCount())
            {
                $_SESSION['msg_sucesso'] = "Poema cadastrado com sucesso!";
                unset($_SESSION['old_nomeAutor']);
                unset($_SESSION['old_novoPoema']);
            }          
            } else{
                $_SESSION['msg_erro'] = implode("<br>", $validar);
            }

            }catch(PDOException $erro) {
                echo "ERRO => " . $erro->getMessage();
            }
        }
}   
