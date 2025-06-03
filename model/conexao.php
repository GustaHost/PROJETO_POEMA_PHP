<?php 
try{
    $pdo = new PDO('mysql:host=localhost;dbname=Usuario_e_livros', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /*$MSQL = $pdo->prepare("INSERT INTO cadastroUsuario.tabelaUsuarios (nomeUsu, cpf, email, numero) VALUES ('Fernando Nunes', 12345678910, 'Gusta2006@gmail.com', 41996966829)");
        $MSQL->execute();*/
}
catch(PDOException $erro) {
    echo "ERRO => " . $erro->getMessage();
}
?>