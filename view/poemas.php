<?php
require_once '../model/conexao.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $poemaIdVisualizado = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if ($poemaIdVisualizado) {
        setcookie('ultimo_poema_visualizado_id', $poemaIdVisualizado, time() + (86400 * 30), "/"); // Cookie válido por 30 dias
    }
}
$ultimoPoemaVisualizadoId = $_COOKIE['ultimo_poema_visualizado_id'] ?? '';


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
        <!------------------------------------------------------------------------------------------------------------------------------------------------>
        <main class="corpos">
            <h1 class="ficar_no_meio">POEMAS</h1>

            <?php
            $queryUsu = "SELECT nomeAutor, novoPoema FROM tabelaPoemas";
            $cadUsuario = $pdo->prepare($queryUsu);
            $cadUsuario->execute();

            if($cadUsuario->rowCount() != 0) { ?>
                <div class="lista-itens-cadastrados">
                    <?php
                    while($rowTable = $cadUsuario->fetch(PDO::FETCH_ASSOC)){
                        $nomeAutor = $rowTable['nomeAutor'];
                        $novoPoema = $rowTable['novoPoema'];

                        
                        if(!empty($nomeAutor) && !empty($novoPoema)){
                        ?>
                        <div class="item-cadastrado"> 
                            <p><strong>Autor:</strong> <?php echo htmlspecialchars($nomeAutor);?></p>
                            <p><strong>Poema:</strong> <br><?php echo nl2br(htmlspecialchars($novoPoema));?></p>
                        </div>
                        <?php 
                        } 
                    } 
                    ?>
                </div>
            <?php
            } else {
                echo "<p class='texto-informacao'>Não existem poemas para serem listados.</p>";
            }
            ?>
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