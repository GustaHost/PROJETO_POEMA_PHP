<?php 
    session_start();

    require_once '../model/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email_do_usuario = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $senha_digitada = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);


    if (empty($email_do_usuario) || empty($senha_digitada)) {
        $_SESSION['login_erro'] = "Por favor, preencha todos os campos.";
        
        $_SESSION['dados_login'] = ['emailLogin' => $email_do_usuario]; 
        header('Location: ../view/login.php'); 
        exit; 
    }


    try {

        $msqlLogin = $pdo->prepare("SELECT id, nome, email, senha FROM tabelaEscritores WHERE email = :email");
        $msqlLogin->execute([
            ':email' => $email_do_usuario
        ]);
        $usuario = $msqlLogin->fetch(PDO::FETCH_ASSOC);

        
        if ($usuario && password_verify($senha_digitada, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['usuario_logado'] = true;
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];

            header('Location: ../view/inicio2.php'); 
            exit;

        } else {
            
            $_SESSION['login_erro'] = "E-mail ou senha inválidos.";
            $_SESSION['dados_login'] = ['emailLogin' => $email_do_usuario];
            header('Location: ../view/login.php');
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['login_erro'] = "Erro interno. Tente novamente mais tarde.";
        $_SESSION['dados_login'] = ['emailLogin' => $email_do_usuario];
        
        header('Location: ../view/login.php');
        exit;
    }

} else {
   
    header('Location: ../view/login.php');
    exit;
}
?>