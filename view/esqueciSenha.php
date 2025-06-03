<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/livro.png" type="image/x-icon">
    <script src="controller/mascara.js" defer></script>
</head>
<body>
    <div class="tudo">    
        <header>
            <nav id="menu">
                <div class="blocos_menus">
                    <a href="inicio2.php" ><img src="img/lendo-um-livro.png" alt="icon" style="height: 60px; width: 60px; border-radius: 5px;"></a>
                </div>

                <div class="blocos_menus">
                    <a href="poemas.php" >Poemas</a>
                </div> 
            
                <div class="blocos_menus">
                    <a href="adicionarPoemas.php" >Adicionar Poemas</a>
                </div>
                
                <div class="blocos_menus">
                    <a href="editarPoemas.php">Editar e Atualizar Poemas</a>
                </div>

                <div class="blocos_menus">
                    <a href="perfil.php" >Perfil</a>
                </div>

               
            </nav>
        </header>
        <!------------------------------------------------------------------------------------------------------------------------------------------------>
        <main class="corpos">
                <h1 class="ficar_no_meio">Recuperação de senha</h1>

                <?php
                    session_start(); // Inicia a sessão para acessar as mensagens

                    // Verifica e exibe a mensagem de SUCESSO
                    if (isset($_SESSION['reset_mensagem'])) {
                        echo '<p class="success-message">' . htmlspecialchars($_SESSION['reset_mensagem']) . '</p>';
                        unset($_SESSION['reset_mensagem']); // Limpa a mensagem após exibir
                    }

                    // Verifica e exibe a mensagem de ERRO
                    if (isset($_SESSION['reset_erro'])) {
                        echo '<p class="error-message">' . htmlspecialchars($_SESSION['reset_erro']) . '</p>';
                        unset($_SESSION['reset_erro']); // Limpa a mensagem após exibir
                    }
                    ?>

                    <p>Informe seu endereço de e-mail para redefinir sua senha.</p>


                    <form action="../controller/processa_EsqueciSenha.php" method="POST">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" required>
                        <input type="submit" value="Redefinir Senha">
                    </form>


                    <p><a href="login.php">Voltar para o Login</a></p>


                
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


        
    </div>
</body>
</html>