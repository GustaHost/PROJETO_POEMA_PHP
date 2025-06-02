<?php 
    session_start();

    require_once 'model/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recebe e filtra os dados do formulário
    // FILTER_SANITIZE_EMAIL e FILTER_SANITIZE_STRING removem caracteres que não são e-mail/string.
    // É uma boa prática básica para prevenir alguns tipos de ataques.
    $email_do_usuario = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $senha_digitada = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);


    if (empty($email_do_usuario) || empty($senha_digitada)) {
        $_SESSION['login_erro'] = "Por favor, preencha todos os campos.";
        // Armazena o e-mail digitado para pré-preencher o formulário novamente
        $_SESSION['dados_login'] = ['emailLogin' => $email_do_usuario]; 
        header('Location: login.php'); // Redireciona de volta para o formulário de login
        exit; // Garante que o script pare a execução após o redirecionamento
    }


    try {

        $msqlLogin = $pdo->prepare("SELECT id, nome, email, senha FROM tabelaEscritores WHERE email = :email");
        $msqlLogin->execute([
            ':email' => $email_do_usuario
        ]);
        $usuario = $msqlLogin->fetch(PDO::FETCH_ASSOC);

        // 3. Verifica se o usuário existe e a senha está correta
        if ($usuario && password_verify($senha_digitada, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['usuario_logado'] = true;
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];

            header('Location: pagina3.php'); // Redirecione para o painel ou página principal
            exit;

        } else {
            // Usuário ou senha inválidos
            $_SESSION['login_erro'] = "E-mail ou senha inválidos.";
            $_SESSION['dados_login'] = ['emailLogin' => $email_do_usuario];
            header('Location: login.php');
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['login_erro'] = "Erro interno. Tente novamente mais tarde.";
        $_SESSION['dados_login'] = ['emailLogin' => $email_do_usuario];
        // error_log("Erro no login: " . $e->getMessage());
        header('Location: login.php');
        exit;
    }

} else {
    // Caso o acesso não venha via POST
    header('Location: login.php');
    exit;
}
?>