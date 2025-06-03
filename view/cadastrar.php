<?php
include_once('../model/conexao.php');
include_once('../controller/validacoes.php');


?>

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
                    <a href="inicio.php" ><img src="img/lendo-um-livro.png" alt="icon" style="height: 60px; width: 60px; border-radius: 5px;"></a>
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
                    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                    if (!empty($dados['cadastroFeito'])) {
                        $dados = array_map('trim', $dados);

                        // Chama a função de validação
                        $validacao = validarDados($dados);

                        if (empty($validacao)) {
                            // Remove caracteres do CPF e telefone para salvar no banco
                            $cpfLimpo = preg_replace('/\D/', '', $dados['cpf']);
                            $telefoneLimpo = preg_replace('/\D/', '', $dados['telefone']);

                            $sql = "INSERT INTO Usuario_e_livros.tabelaEscritores (nome, cpf, email, senha, telefone)
                                    VALUES (:nome, :cpf, :email, :senha, :telefone)";
                            $cadUsuario = $pdo->prepare($sql);
                            $cadUsuario->execute([
                                ':nome' => $dados['nome'],
                                ':cpf' => $cpfLimpo,
                                ':email' => $dados['email'],
                                ':senha' => password_hash($dados['senha'], PASSWORD_DEFAULT),
                                ':telefone' => $telefoneLimpo
                            ]);

                            if ($cadUsuario->rowCount()) {
                                echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p><br>";
                                $dados = []; // Limpa os dados do formulário
                                header('Location: login.php');
                            } else {
                                echo "<p style='color: red;'>Erro ao cadastrar usuário!</p><br>";
                            }
                        } else {
                            // Exibe erros de validação
                            foreach ($validacao as $erro) {
                                echo "<p style='color: red;'>$erro</p>";
                            }
                        }
                    }
                ?>
                

                <form name="cadastroUsuario" method="post" action="">
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