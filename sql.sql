create schema Usuario_e_livros;
use Usuario_e_livros;
CREATE TABLE tabelaEscritores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    cpf VARCHAR(11),         
    email VARCHAR(30),
    senha VARCHAR(255),
    telefone VARCHAR(11)       
);

TRUNCATE TABLE tabelaEscritores; -- apaga tudo os registros

select * from tabelaEscritores;

/*Tabela para adicionar novos poemas */


CREATE TABLE tabelaPoemas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomeAutor VARCHAR(255),
    novoPoema LONGTEXT   
);

TRUNCATE TABLE tabelaPoemas; -- apaga tudo os registros

select * from tabelaPoemas;







