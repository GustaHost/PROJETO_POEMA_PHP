<?php
require_once 'conexao.php'; 

class Poema {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Função para APAGAR um poema
    public function deletar($id) {
        $sql = "DELETE FROM tabelaPoemas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Função para ATUALIZAR um poema
    public function atualizar($id, $nomeAutor, $novoPoema) {
        $sql = "UPDATE tabelaPoemas SET nomeAutor = :nomeAutor, novoPoema = :novoPoema WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nomeAutor', $nomeAutor);
        $stmt->bindParam(':novoPoema', $novoPoema);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Função para PEGAR UM poema por ID
    public function pegarPorId($id) {
        $sql = "SELECT id, nomeAutor, novoPoema FROM tabelaPoemas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Função para PEGAR TODOS os poemas
    public function pegarTodos() {
        $sql = "SELECT id, nomeAutor, novoPoema FROM tabelaPoemas ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Função para ADICIONAR um poema (copiada de novoPoemaController.php)
    public function adicionar($nomeAutor, $novoPoema) {
        $sql = "INSERT INTO tabelaPoemas (nomeAutor, novoPoema) VALUES (:nomeAutor, :novoPoema)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nomeAutor', $nomeAutor);
        $stmt->bindParam(':novoPoema', $novoPoema);
        return $stmt->execute();
    }
}