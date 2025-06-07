<?php
session_start(); // Inicia a sessão para recuperar mensagens e dados

include_once('../model/conexao.php'); // Correção de caminho
include_once('../controller/validacoes.php'); // Correção de caminho e a função validarDados está agora no controller

// Recupera dados do formulário se houver erro (para repopular)
$dados = [];
if (isset($_SESSION['dados_formulario'])) {
    $dados = $_SESSION['dados_formulario'];
    unset($_SESSION['dados_formulario']); // Limpa após usar
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Alma Por Trás do Verso</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/livro.png" type="image/x-icon">
    <script src="../controller/mascara.js" defer></script>
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
                <h1 class="ficar_no_meio">CADASTRAR-SE</h1>

                <?php 
                // Exibe mensagens de sucesso
                if (isset($_SESSION['cadastro_sucesso'])) {
                    echo "<p style='color: green; text-align: center;'>" . htmlspecialchars($_SESSION['cadastro_sucesso']) . "</p><br>";
                    unset($_SESSION['cadastro_sucesso']);
                }
                // Exibe mensagens de erro gerais
                if (isset($_SESSION['cadastro_erro'])) {
                    echo "<p style='color: red; text-align: center;'>" . htmlspecialchars($_SESSION['cadastro_erro']) . "</p><br>";
                    unset($_SESSION['cadastro_erro']);
                }
                // Exibe erros de validação
                if (isset($_SESSION['cadastro_erro_validacao'])) {
                    foreach ($_SESSION['cadastro_erro_validacao'] as $erro) {
                        echo "<p style='color: red; text-align: center;'>$erro</p>";
                    }
                    unset($_SESSION['cadastro_erro_validacao']);
                }
                ?>
                

                <form name="cadastroUsuario" method="post" action="../controller/processa_cadastro.php">
                    <LABEL>NOME: </LABEL>
                    <input type="text" name="nome" id="nome" placeholder="Nome completo" value="<?php if(isset($dados['nome'])){echo $dados['nome'];} ?>">
                    <br><br>
                    <label>CPF: </label>
                    <input type="text" name="cpf" id="cpf" placeholder="Informe seu cpf" maxlength="14" onkeyup="mascaraCPF()" value="<?php if(isset($dados['cpf'])){echo $dados['cpf'];} ?>">
                    <br><br>
                    <LABEL>EMAIL: </LABEL>
                    <input type="text" name="email" id="email" placeholder="Digite seu email" value="<?php if(isset($dados['email'])){echo $dados['email'];} ?>">
                    <br><br>
                    <LABEL>SENHA: </LABEL>
                    <input type="password" name="senha" id="senha" placeholder="Digite uma senha" value="<?php if(isset($dados['senha'])){echo $dados['senha'];} ?>">
                    <br><br>
                    <LABEL>NUMERO: </LABEL>
                    <input type="text" name="telefone" id="telefone" placeholder="(00) 00000-0000" onkeyup="mascaraTelefone()"  value="<?php if(isset($dados['telefone'])){echo $dados['telefone'];} ?>">
                    <br><br>
                    <input type="submit" value="cadastroFeito" name="cadastroFeito">


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


        
    </div>
</body>
</html>