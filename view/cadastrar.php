<?php
session_start(); 

include_once('../model/conexao.php'); 
include_once('../controller/validacoes.php');


$dados = [];
if (isset($_SESSION['dados_formulario'])) {
    $dados = $_SESSION['dados_formulario'];
    unset($_SESSION['dados_formulario']);
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
                
                <div class="container-do-formulario"> 
                    <form name="cadastroUsuario" method="post" action="../controller/processa_cadastro.php">
                        <div class="grupo-de-campo">
                            <LABEL>NOME: </LABEL>
                            <input type="text" name="nome" id="nome" placeholder="Nome completo" value="<?php if(isset($dados['nome'])){echo $dados['nome'];} ?>">
                        </div>
                        <br><br>
                        <div class="grupo-de-campo">
                            <label>CPF: </label>
                            <input type="text" name="cpf" id="cpf" placeholder="Informe seu cpf" maxlength="14" onkeyup="mascaraCPF()" value="<?php if(isset($dados['cpf'])){echo $dados['cpf'];} ?>">
                        </div>
                        <br><br>
                        <div class="grupo-de-campo">
                            <LABEL>EMAIL: </LABEL>
                            <input type="text" name="email" id="email" placeholder="Digite seu email" value="<?php if(isset($dados['email'])){echo $dados['email'];} ?>">
                        </div>
                        <br><br>
                        <div class="grupo-de-campo">
                            <LABEL>SENHA: </LABEL>
                            <input type="password" name="senha" id="senha" placeholder="Digite uma senha" value="<?php if(isset($dados['senha'])){echo $dados['senha'];} ?>">
                        </div>
                        <br><br>
                        <div class="grupo-de-campo">
                            <LABEL>NUMERO: </LABEL>
                            <input type="text" name="telefone" id="telefone" placeholder="(00) 00000-0000" onkeyup="mascaraTelefone()"  value="<?php if(isset($dados['telefone'])){echo $dados['telefone'];} ?>">
                        </div>
                        <br><br>
                            <input type="submit" class="botao-de-envio" value="cadastroFeito" name="cadastroFeito">


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


        
    </div>
</body>
</html>