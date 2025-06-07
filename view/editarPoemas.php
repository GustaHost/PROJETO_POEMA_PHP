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
            if ($msg_sucesso): ?><p id="mensagemSucesso" style="color:green; text-align:center;"><?php echo htmlspecialchars($msg_sucesso); ?></p><?php endif; ?>
            <?php if ($msg_erro): ?><p id="mensagemErro" style="color:red; text-align: center;"><?php echo htmlspecialchars($msg_erro); ?></p><?php endif; ?>
            <?php if ($msg_info): ?><p style='color: gray; text-align: center;'><?php echo htmlspecialchars($msg_info); ?></p><?php endif; ?>

            <?php if ($poemaParaEditar): // Mostra o formulário de edição se um poema foi carregado pelo Controller ?>
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
            // Mostra a lista de poemas, usando os dados do Controller
            if (!empty($listaDePoemas)): ?>
                <div class="lista-poemas">
                    <?php foreach ($listaDePoemas as $rowTable): ?>
                        <div>
                            <p><strong>ID:</strong> <?php echo htmlspecialchars($rowTable['id']);?></p>
                            <p><strong>Autor:</strong> <?php echo htmlspecialchars($rowTable['nomeAutor']);?></p>
                            <p><strong>Poema:</strong> <br><?php echo nl2br(htmlspecialchars($rowTable['novoPoema']));?></p>
                            <div>
                                <a href="editarPoemas.php?action=excluir&id=<?php echo htmlspecialchars($rowTable['id']); ?>" onclick="return confirm('Tem certeza que deseja excluir este poema?');">Excluir</a>
                                <a href="editarPoemas.php?action=editar&id=<?php echo htmlspecialchars($rowTable['id']); ?>">Editar</a>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                </div>
            <?php 
            // Se não há poemas e nenhuma outra mensagem, exibe um aviso padrão
            elseif (empty($msg_info) && empty($msg_erro)): ?>
                <p style='color: red; text-align: center;'>Não existem registros a serem listados.</p><br>
            <?php endif; ?>

        </main>
        
        <p id="frase">muito obrigado por visitar o site</p>
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
                <p>Visite nossos canal no instagram e no facebook</p>
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