<?php
require_once '../model/conexao.php';
require_once '../controller/novoPoemaController.php'; 

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

// Lógica da exclusão
if(isset($_GET['action']) && $_GET['action'] == 'excluir' && !empty($_GET['id'])){
    $id = $_GET['id'];
    try{
        $sqlDelete = "DELETE FROM tabelaPoemas WHERE id = :id";
        $resultDeletar = $pdo->prepare($sqlDelete);
        $resultDeletar->bindParam(':id', $id, PDO::PARAM_INT);
        if($resultDeletar->execute()){
            $_SESSION['msg_sucesso'] = "Poema excluído com sucesso!";
        } else {
            $_SESSION['msg_erro'] = "Erro ao excluir o poema.";
        }
    } catch(PDOException $erro) {
        $_SESSION['msg_erro'] = "ERRO ao excluir: " . $erro->getMessage();
    }
    header("Location: editarPoemas.php"); // Redireciona para a própria página
    exit();
}

// Lógica da atualização
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AtualizarUsu'])){
    $id = $_POST['id'] ?? null;
    $nomeAutor = trim($_POST['nomeAutor'] ?? '');
    $novoPoema = trim($_POST['novoPoema'] ?? '');

    // Validando os campos
    if(empty($id) || empty($nomeAutor) || empty($novoPoema)){
        $_SESSION['msg_erro'] = "Autor e Poema não podem ser vazios para atualização.";
    } else {
        try{
            $sqlUpdate = "UPDATE tabelaPoemas SET nomeAutor = :nomeAutor, novoPoema = :novoPoema WHERE id = :id";
            $resultAtualizar = $pdo->prepare($sqlUpdate);
            $resultAtualizar->bindParam(':nomeAutor', $nomeAutor);
            $resultAtualizar->bindParam(':novoPoema', $novoPoema);
            $resultAtualizar->bindParam(':id', $id, PDO::PARAM_INT);

            if($resultAtualizar->execute()){
                $_SESSION['msg_sucesso'] = "Poema atualizado com sucesso!";
            } else {
                $_SESSION['msg_erro'] = "Erro ao atualizar o poema.";
            } 
        } catch(PDOException $e) {
            $_SESSION['msg_erro'] = "Erro de banco de dados ao atualizar: " . $e->getMessage();
        }
    }
    header("Location: editarPoemas.php"); 
    exit();
}

// Lógica para carregar dados da edição
$poemaParaEditar = null;
if(isset($_GET['action']) && $_GET['action'] == 'editar' && !empty($_GET['id'])){
    $id = $_GET['id'];
    $queryConsultaUpdate = "SELECT id, nomeAutor, novoPoema FROM tabelaPoemas WHERE id = :id";
    $resultConsultaUpdate = $pdo->prepare($queryConsultaUpdate);
    $resultConsultaUpdate->bindParam(':id', $id, PDO::PARAM_INT);
    $resultConsultaUpdate->execute();
    $poemaParaEditar = $resultConsultaUpdate->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Atualizar</title>
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
                <h1 class="ficar_no_meio">Editar e Atualizar Poemas</h1>

                <?php
                    if(isset($_SESSION['msg_sucesso'])){
                        echo '<p id="mensagemSucesso" style="color:green; text-align:center;">' . $_SESSION['msg_sucesso'] . '</p>';
                        unset($_SESSION['msg_sucesso']);
                    }
                    if(isset($_SESSION['msg_erro'])){
                        echo '<p id="mensagemErro" style="color:red; text-align: center;">' . $_SESSION['msg_erro'] . '</p>';
                        unset($_SESSION['msg_erro']);
                    }
                ?>

                <?php if ($poemaParaEditar): ?>
                    <form action="" name="AtualizarUsuario" method="POST">
                        <label>ID:</label>
                        <input type="text" name="id" value="<?php echo htmlspecialchars($poemaParaEditar['id']); ?>" readonly><br><br>

                        <label>Autor:</label>
                        <input type="text" name="nomeAutor" id="nomeAutor" placeholder="Nome" value="<?php echo htmlspecialchars($poemaParaEditar['nomeAutor']); ?>" required><br><br>

                        <label>Poema:</label>
                        <textarea name="novoPoema" id="novoPoema" placeholder="Poema" rows="10" cols="50" required><?php echo htmlspecialchars($poemaParaEditar['novoPoema']); ?></textarea><br><br>

                        <input type="submit" value="Atualizar" name="AtualizarUsu">
                    </form>
                    <?php endif; ?>

                    <?php
                    $queryListarPoemas = "SELECT id, nomeAutor, novoPoema FROM tabelaPoemas ORDER BY id DESC";
                $cadUsuario = $pdo->prepare($queryListarPoemas);
                $cadUsuario->execute();

                if($cadUsuario->rowCount() > 0)
                {?>
                    <div class="lista-poemas"> <?php
                        while($rowTable = $cadUsuario->fetch(PDO::FETCH_ASSOC)){
                            $id = $rowTable['id'];
                            $nomeAutor = $rowTable['nomeAutor'];
                            $novoPoema = $rowTable['novoPoema'];
                        ?>
                        <div> <p><strong>ID:</strong> <?php echo htmlspecialchars($id);?></p>
                            <p><strong>Autor:</strong> <?php echo htmlspecialchars($nomeAutor);?></p>
                            <p><strong>Poema:</strong> <br><?php echo nl2br(htmlspecialchars($novoPoema));?></p>
                            <div>
                                <a href="editarPoemas.php?action=excluir&id=<?php echo htmlspecialchars($id); ?>" onclick="return confirm('Tem certeza que deseja excluir este poema?');">Excluir</a>
                                
                                <a href="editarPoemas.php?action=editar&id=<?php echo htmlspecialchars($id); ?>">Editar</a>
                            </div>
                        </div>
                        <hr> <?php } ?>
                    </div>
                <?php
                }
                else{
                    echo "<p style='color: red; text-align: center;'>Não existem registros a serem listados.</p><br>";
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