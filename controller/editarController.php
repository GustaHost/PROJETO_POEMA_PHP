<?php

session_start(); 

require_once '../model/conexao.php'; 
require_once '../model/editarPoema.php';
require_once '../controller/novoPoemaController.php'; 

$poemaModel = new Poema($pdo);

$poemaParaEditar = null; 
$listaDePoemas = [];     

// Lógica de exclusão
if (isset($_GET['action']) && $_GET['action'] == 'excluir' && !empty($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if ($id) {
        if ($poemaModel->deletar($id)) {
            $_SESSION['msg_sucesso'] = "Poema excluído!";
        } else {
            $_SESSION['msg_erro'] = "Erro ao excluir.";
        }
    } else {
        $_SESSION['msg_erro'] = "ID inválido.";
    }
    header("Location: ../view/editarPoemas.php"); 
    exit();
}

// Lógica de atualização
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AtualizarUsu'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nomeAutor = trim(filter_input(INPUT_POST, 'nomeAutor', FILTER_DEFAULT));
    $novoPoema = trim(filter_input(INPUT_POST, 'novoPoema', FILTER_DEFAULT));

    if ($id && !empty($nomeAutor) && !empty($novoPoema)) {
        if ($poemaModel->atualizar($id, $nomeAutor, $novoPoema)) {
            $_SESSION['msg_sucesso'] = "Poema atualizado!";
        } else {
            $_SESSION['msg_erro'] = "Erro ao atualizar.";
        }
    } else {
        $_SESSION['msg_erro'] = "Dados inválidos para atualização.";
    }
    header("Location: ../view/editarPoemas.php"); 
    exit();
}

// Lógica de ediçãp
if (isset($_GET['action']) && $_GET['action'] == 'editar' && !empty($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if ($id) {
        $poemaParaEditar = $poemaModel->pegarPorId($id);
        if (!$poemaParaEditar) {
            $_SESSION['msg_erro'] = "Poema não encontrado.";
            header("Location: ../view/editarPoemas.php"); 
        }
    } else {
        $_SESSION['msg_erro'] = "ID inválido para edição.";
        header("Location: ../view/editarPoemas.php");
        exit();
    }
}

//Lógica para pegar os poemas
try {
    $listaDePoemas = $poemaModel->pegarTodos();
    if (empty($listaDePoemas)) {
        $_SESSION['msg_info'] = "Nenhum poema cadastrado.";
    }
} catch (PDOException $e) {
    $_SESSION['msg_erro'] = "Erro ao listar poemas: " . $e->getMessage();
}
