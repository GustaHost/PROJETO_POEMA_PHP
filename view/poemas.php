<?php
require_once '../model/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POEMAS</title>
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
                <h1 class="ficar_no_meio">POEMAS</h1>
                
                <?php
                $queryUsu = "SELECT nomeAutor, novoPoema FROM tabelaPoemas";
                $cadUsuario = $pdo->prepare($queryUsu);
                $cadUsuario->execute();

                //Listando os poemas
                if($cadUsuario->rowCount() != 0)
                {?>
                <table>
                    <thead>
                        <tr>
                            <th>Autor:</th>
                            <th>Poema:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($rowTable = $cadUsuario->fetch(PDO::FETCH_ASSOC)){
                                $nomeAutor = $rowTable['nomeAutor'];
                                $novoPoema = $rowTable['novoPoema'];

                                //Garantir para que não venha poemas vazios
                                if(!empty($nomeAutor) && !empty($novoPoema)){
                                ?>
                                    <div class="poema-item"> 
                                    <p class="poema-autor"><strong>Autor:</strong> 
                                    <?php echo htmlspecialchars($nomeAutor);?></p>
                                    <p class="poema-conteudo"><strong>Poema:</strong> <br>
                                    <?php echo nl2br(htmlspecialchars($novoPoema));?></p>
                                </div>
                                <hr>
                            <?php 
                                } 
                            } 
                        ?>
                    </tbody>
                </table>
            <?php
                }
                else{
                    echo "<p style='color: red; text-align: center;'>Não existem registros a serem listados.</><br>";
                }
                ?>                       
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