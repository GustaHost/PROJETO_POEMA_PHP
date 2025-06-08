<?php
require_once '../controller/editarController.php';

$msg_sucesso = $_SESSION['msg_sucesso'] ?? '';
$msg_erro = $_SESSION['msg_erro'] ?? '';
$msg_info = $_SESSION['msg_info'] ?? '';
unset($_SESSION['msg_sucesso'], $_SESSION['msg_erro'], $_SESSION['msg_info']);

if (isset($_GET['action']) && $_GET['action'] == 'editar' && !empty($_GET['id'])) {
    setcookie('ultimo_poema_editado_id', $_GET['id'], time() + (86400 * 30), "/"); // Cookie válido por 30 dias
}

$ultimoPoemaEditadoId = $_COOKIE ['ultimo_poema_editado_id'] ?? '';
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

        <main class="corpos">
            <h1 class="ficar_no_meio">Editar e Atualizar Poemas</h1>

            <?php 
            
            if ($msg_sucesso): ?>
                <p class="mensagem-sucesso"><?php echo htmlspecialchars($msg_sucesso); ?></p>
            <?php endif; ?>
            <?php if ($msg_erro): ?>
                <p class="mensagem-erro"><?php echo htmlspecialchars($msg_erro); ?></p>
            <?php endif; ?>
            <?php if ($msg_info): ?>
                <p class="mensagem-info"><?php echo htmlspecialchars($msg_info); ?></p>
            <?php endif; ?>

            <?php if ($poemaParaEditar):  ?>
                <div class="container-do-formulario">
                    <h2 class="ficar_no_meio">Editar Poema</h2>
                    <form action="" name="AtualizarUsuario" method="POST">
                        <div class="grupo-de-campo">
                            <label for="id">ID:</label>
                            <input type="text" name="id" id="id" class="campo-de-entrada" value="<?php echo htmlspecialchars($poemaParaEditar['id']); ?>" readonly>
                        </div>

                        <div class="grupo-de-campo">
                            <label for="nomeAutor">Autor:</label>
                            <input type="text" name="nomeAutor" id="nomeAutor" placeholder="Nome do autor" class="campo-de-entrada" value="<?php echo htmlspecialchars($poemaParaEditar['nomeAutor']); ?>" required>
                        </div>

                        <div class="grupo-de-campo">
                            <label for="novoPoema">Poema:</label>
                            <textarea name="novoPoema" id="novoPoema" placeholder="Conteúdo do poema" rows="10" class="campo-de-entrada" required><?php echo htmlspecialchars($poemaParaEditar['novoPoema']); ?></textarea>
                        </div>

                        <button type="submit" name="AtualizarUsu" class="botao-de-envio">Atualizar Poema</button>
                    </form>
                </div>
            <?php endif; ?>

            <?php 
          
            if (!empty($listaDePoemas)): ?>
                
                <div class="lista-itens-cadastrados">
                    <?php foreach ($listaDePoemas as $rowTable): ?>
                        <div class="item-cadastrado">
                            <p><strong>ID:</strong> <?php echo htmlspecialchars($rowTable['id']);?></p>
                            <p><strong>Autor:</strong> <?php echo htmlspecialchars($rowTable['nomeAutor']);?></p>
                            <p><strong>Poema:</strong> <br><?php echo nl2br(htmlspecialchars($rowTable['novoPoema']));?></p>
                            <div class="acoes-item">
                                <a href="editarPoemas.php?action=excluir&id=<?php echo htmlspecialchars($rowTable['id']); ?>" class="botao-acao botao-excluir" onclick="return confirm('Tem certeza que deseja excluir este poema?');">Excluir</a>
                                <a href="editarPoemas.php?action=editar&id=<?php echo htmlspecialchars($rowTable['id']); ?>" class="botao-acao botao-editar">Editar</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php 
           
            elseif (empty($msg_info) && empty($msg_erro) && empty($msg_sucesso) && empty($poemaParaEditar)): ?>
                <p class="texto-informacao">Não existem poemas cadastrados.</p>
            <?php endif; ?>
        </main>
        
        
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