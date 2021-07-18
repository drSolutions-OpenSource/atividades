--
-- Tabelas utilziadas e valores iniciais
--
-- Software sugerido para SQLite: SQLiteStudio - https://sqlitestudio.pl/
--
-- Sistema para gerenciar a lista de atividades (to do list)
--
-- @author  Diego Mendes Rodrigues
-- @since   Julho/2021
-- @version 1.0
--

-- ------------------------------------------------------------
-- Criação das tabelas
-- ------------------------------------------------------------
-- Atividades
CREATE TABLE atividades (
    id        INTEGER       PRIMARY KEY AUTOINCREMENT,
    titulo    VARCHAR (250) NOT NULL,
    data      DATE          NOT NULL,
    descricao TIME,
    categoria INTEGER       NOT NULL
                            DEFAULT (1),
    concluido INTEGER (1)   DEFAULT (0) 
);

-- Categorias
CREATE TABLE categorias (
    id   INTEGER      PRIMARY KEY AUTOINCREMENT,
    nome VARCHAR (10) NOT NULL,
    cor  INTEGER      DEFAULT (1) 
);

-- Cores
CREATE TABLE cores (
    id   INTEGER      PRIMARY KEY AUTOINCREMENT,
    nome VARCHAR (10) NOT NULL
);

-- ------------------------------------------------------------
-- Valores inicias nas tabelas
-- ------------------------------------------------------------
INSERT INTO cores (nome) VALUES ('Amarela');
INSERT INTO cores (nome) VALUES ('Azul');
INSERT INTO cores (nome) VALUES ('Laranja');
INSERT INTO cores (nome) VALUES ('Roxa');
INSERT INTO cores (nome) VALUES ('Verde');
INSERT INTO cores (nome) VALUES ('Vermelha');

INSERT INTO categorias (nome, cor) VALUES ('Geral', 6);
INSERT INTO categorias (nome, cor) VALUES ('Pessoal', 1);
INSERT INTO categorias (nome, cor) VALUES ('Trabalho', 5);
INSERT INTO categorias (nome, cor) VALUES ('Viagens', 2);

INSERT INTO atividades (titulo, data, descricao) VALUES ('Configurar autenticação', '2021-08-01', 'Configurar utilizando a autenticação básica com o Apache');