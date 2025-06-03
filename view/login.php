<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/livro.png" type="image/x-icon">
    <script src="controller/mascara.js" defer></script>
</head>
<body>
    <div class="tudo">    
        <header>
            <nav id="menu">
                <div class="blocos_menus">
                    <a href="inicio.php" ><img src="img/lendo-um-livro.png" alt="icon" style="height: 60px; width: 60px; border-radius: 5px;"></a>
                </div>

                <div class="blocos_menus">
                    <a href="cadastrar.php" >Cadastrar-se</a>
                </div> 
            
                <div class="blocos_menus">
                    <a href="login.php" >Entrar</a>
                </div>

               
            </nav>
        </header>
        <!------------------------------------------------------------------------------------------------------------------------------------------------>
        <main class="corpos">
                <h1 class="ficar_no_meio">LOGIN</h1>

                <?php 
                    session_start();

                    $dados = []; // Inicializa a variável para evitar "undefined variable"
                    if(isset($_SESSION['dados_login'])){
                        $dados = $_SESSION['dados_login'];
                        unset($_SESSION['dados_login']); // Limpa os dados da sessão após recuperá-los
                    }

                    // Verifica e exibe a mensagem de erro (use 'login_error' consistentemente)
                    if(isset($_SESSION['login_erro'])){
                        echo '<p> ' . htmlspecialchars($_SESSION['login_erro']) . ' </p>'; // Use htmlspecialchars
                        unset($_SESSION['login_erro']); // Limpa a mensagem de erro da sessão
                    }
                    ?>

                    <form name="login" method="post" action="../controller/processa_login.php">
                        <LABEL>EMAIL: </LABEL>
                        <input type="text" name="email" id="emailLogin" placeholder="*******@*****.***" value="<?php if(isset($dados['emailLogin'])){echo htmlspecialchars($dados['emailLogin']);} ?>">
                        <br><br>
                        <LABEL>SENHA: </LABEL>
                        <input type="password" name="senha" id="senhaLogin" placeholder="************" value=""> 
                        <br><br>
                        <input type="submit" value="Entrar" name="loginFeito">
                        <p><a href="esqueciSenha.php">Esqueci minha senha</a></p>
                        <br><br>
                        <p>Ainda não tem conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
                </form>
                    


                </form>


            </main>
        

         <!------------------------------------------------------------------------------------------------------------------------------------------------>
         <p id="frase">
            muito obrigado por visitar o site
        </p>
        <footer id="rodape">
            
            
            <div class="blocos_rodape">
                <div class="bloquinhos">
                    <p><strong>Atendimento:</strong> (11) 99999-9999 | contato@petshop.com</p>
                </div>
                <div class="bloquinhos">
                    <p><strong>Endereço:</strong> Rua dos Bichinhos, 123 - São Paulo, SP</p>
                </div>
                <div class="bloquinhos">
                    <p><strong>Horário:</strong> Seg a Sáb - 9h às 18h</p>
                </div>
                
                
                
            </div>

            <div class="blocos_rodape">
                <p>
                    Visite nossos canal no instagram e no facebook
                </p>
                <a href="https://instagram.com/petshop" target="_blank">
                    <img src="img/instagram.png" alt="logo instagram" style="height: 50px; width: 50px;">
                </a>
                <a href="https://facebook.com/petshop" target="_blank">
                    <img src="img/facebook.png" alt="logo facebook" style="height: 50px; width: 50px;">
                </a>
            </div>
        </footer>


        <script src="js/javaScript.js"></script>
    </div>
</body>
</html>