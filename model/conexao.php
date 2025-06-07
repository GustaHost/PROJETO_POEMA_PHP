<?php 
try{
    $pdo = new PDO('mysql:host=localhost;dbname=Usuario_e_livros', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // $MSQL = $pdo->prepare("INSERT INTO Usuario_e_livros.tabelaPoemas (nomeAutor, nomePoema) VALUES ('Fernando Nunes','Gusta2006@gmail.com')");
    //     $MSQL->execute();
}
catch(PDOException $erro) {
    echo "ERRO => " . $erro->getMessage();
}
?>