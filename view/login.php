<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Alma Por Trás do Verso</title>
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
                    <a href="sobreNos.php" >Sobre nós</a>
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
            <h1 class="ficar_no_meio">Entrar</h1>

            <?php 
            session_start();

            $dados = []; 
            if(isset($_SESSION['dados_login'])){
                $dados = $_SESSION['dados_login'];
                unset($_SESSION['dados_login']); 
            }

            
            if(isset($_SESSION['login_erro'])){
                echo '<p class="mensagem-erro"> ' . htmlspecialchars($_SESSION['login_erro']) . ' </p>'; 
                unset($_SESSION['login_erro']); 
            }
            ?>

            <div class="container-do-formulario"> <form name="login" method="post" action="../controller/processa_login.php">
                    <div class="grupo-de-campo"> 
                        <label for="emailLogin">EMAIL: </label>
                        <input type="email" name="email" id="emailLogin" placeholder="seuemail@exemplo.com" value="<?php if(isset($dados['emailLogin'])){echo htmlspecialchars($dados['emailLogin']);} ?>" class="campo-de-entrada">
                    </div>
                    
                    <div class="grupo-de-campo">
                        <label for="senhaLogin">SENHA: </label>
                        <input type="password" name="senha" id="senhaLogin" placeholder="************" value="" class="campo-de-entrada"> 
                    </div>
                    
                    <button type="submit" name="loginFeito" class="botao-de-envio">Entrar</button> <p class="links-form"> <a href="esqueciSenha.php">Esqueci minha senha</a>
                    </p>
                    
                    <p class="links-form">
                        Ainda não tem conta? <a href="cadastrar.php">Cadastre-se aqui</a>
                    </p>
                </form>
            </div>
        </main>
        

         <!------------------------------------------------------------------------------------------------------------------------------------------------>
        
        <footer id="rodape">
            
            
            <div class="blocos_rodape">
                <div class="bloquinhos">
                    <p><strong>Atendimento:</strong> (11) 99999-9999 | contato@livros.com</p>
                </div>
                <div class="bloquinhos">
                    <p><strong>Endereço:</strong> Rua dos livros, 123 - São Paulo, SP</p>
                </div>
                <div class="bloquinhos">
                    <p><strong>Horário de funcionamento do site:</strong> Seg a Sáb - 9h às 18h</p>
                </div>
                
                
                
            </div>

            <div class="blocos_rodape">
                <p>
                    Visite nossos canal no instagram e no facebook
                </p>
                <a href="https://instagram.com/livros" target="_blank">
                    <img src="img/instagram.png" alt="logo instagram" style="height: 50px; width: 50px;">
                </a>
                <a href="https://facebook.com/livros" target="_blank">
                    <img src="img/facebook.png" alt="logo facebook" style="height: 50px; width: 50px;">
                </a>
            </div>
        </footer>


        <script src="js/javaScript.js"></script>
    </div>
</body>
</html>