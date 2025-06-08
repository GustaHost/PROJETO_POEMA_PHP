<?php
session_start();
require_once '../controller/novoPoemaController.php';

if (isset($_POST['nomeAutor']) && !empty($_POST['nomeAutor'])) {
    setcookie('ultimo_autor_adicionado', $_POST['nomeAutor'], time() + (86400 * 30), "/"); // Cookie válido por 30 dias
}

$ultimoAutor = $_COOKIE['ultimo_autor_adicionado'] ?? '';
?>
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
                    <a href="sobreNos2.php" >Sobre nós</a>
                </div>

                <div class="blocos_menus">
                    <a href="perfil.php" >Perfil</a>
                </div>

               
            </nav>
        </header>
        <!---------------------------------------------------------------------------------------------------------------------------------------------->

        
            <main class="corpos">
                
                <h1 class="ficar_no_meio">Adicionar Poemas</h1>

                <?php
                if(isset($_SESSION['msg_sucesso'])){
                    echo"<p id='mensagemSucesso' style ='color:green; text-align: center;'>" . $_SESSION['msg_sucesso'] . "</php>";
                    unset($_SESSION['msg_sucesso']);
                }
                if(isset($_SESSION['msg_erro'])){
                    echo"<p id='mensagemErro' style= 'color: red; text-align: center;'>" . $_SESSION['msg_erro'] . "</p>";
                    unset($_SESSION['msg_erro']);
                }

                ?>
                <div class="container-do-formulario"> 
                    <form action="" method="post">
                        <div class="grupo-de-campo"> 
                            <label>Autor:</label><br><br>
                            <input type="text" name="nomeAutor" id="nomeAutor" placeholder="Nome" onkeyup="somenteLetras(this);" value= "<?php if(isset($_POST['nomeAutor'])){echo $_POST['nomeAutor'];}?>"></input>
                        </div>
                        <br><br>
                        <div class="grupo-de-campo"> 
                            <label>Poema:</label><br><br>
                            <textarea type="text" name="novoPoema" id="novoPoema" placeholder="Era uma vez..." value="<?php if(isset($_POST['novoPoema'])){echo $_POST['novoPoema'];}?>"></textarea>
                        </div>
                        <br><br>
                            <input type="submit" class="botao-de-envio" value="SALVAR" name="cadastrarPoema">
                    </form>
                </div>
            </main>
        

         <!------------------------------------------------------------------------------------------------------------------------------------------------>
        
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