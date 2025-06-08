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
                    <a href="cadastrar.php" >Cadastrar-se</a>
                </div> 

                <div class="blocos_menus">
                    <a href="sobreNos.php" >Sobre nós</a>
                </div>
            
                <div class="blocos_menus">
                    <a href="login.php" >Entrar</a>
                </div>

                


               
            </nav>
        </header>
        <!------------------------------------------------------------------------------------------------------------------------------------------------>
        <main class="corpos">
            <h1 class="ficar_no_meio">Recuperação de senha</h1>

            <?php
            session_start(); 

            
            if (isset($_SESSION['reset_mensagem'])) {
                echo '<p class="mensagem-sucesso">' . htmlspecialchars($_SESSION['reset_mensagem']) . '</p>'; 
                unset($_SESSION['reset_mensagem']); 
            }

            
            if (isset($_SESSION['reset_erro'])) {
                echo '<p class="mensagem-erro">' . htmlspecialchars($_SESSION['reset_erro']) . '</p>'; 
                unset($_SESSION['reset_erro']); 
            }
            ?>

            <div class="container-do-formulario"> 
                <p class="texto-informacao">Informe seu endereço de e-mail para redefinir sua senha.</p>

                <form action="../controller/processa_EsqueciSenha.php" method="POST">
                    <div class="grupo-de-campo">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" required class="campo-de-entrada">
                    </div>
                    
                    <button type="submit" class="botao-de-envio">Redefinir Senha</button> </form>

                <p class="links-form"><a href="login.php">Voltar para o Login</a></p>
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


        
    </div>
</body>
</html>