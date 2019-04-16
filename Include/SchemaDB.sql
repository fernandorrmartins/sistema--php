-- SchemaDB referente ao Banco de Dados da Solução

CREATE DATABASE unilavras;
ALTER DATABASE unilavras CHARACTER SET utf8 COLLATE utf8_general_ci;
USE unilavras;

CREATE TABLE cliente(
	Identificador BIGINT PRIMARY KEY AUTO_INCREMENT,
	CodigoCliente VARCHAR(7) UNIQUE NOT NULL,
	Nome VARCHAR(60) NOT NULL,
	Celular VARCHAR(14) NOT NULL,
	Email VARCHAR(40) NOT NULL,
	Rua VARCHAR(200) NOT NULL,
	Numero INT NOT NULL,
	Bairro VARCHAR(100) NOT NULL,
	Cidade VARCHAR(100) NOT NULL,
	Cep VARCHAR(9) NOT NULL,
	Estado VARCHAR(2) NOT NULL,
	TipoCliente SMALLINT NOT NULL,
	Setor INT NOT NULL,
	Curso INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE solicitacao (
	Identificador BIGINT PRIMARY KEY AUTO_INCREMENT,
	Cliente BIGINT NOT NULL,
	ServicoSolicitado VARCHAR(400) NOT NULL,
	DataSolicitacao DATETIME NOT NULL DEFAULT NOW()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE setor(
	Identificador INT PRIMARY KEY AUTO_INCREMENT,
	Setor VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE curso(
	Identificador INT PRIMARY KEY AUTO_INCREMENT,
	Curso VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE solicitacao ADD CONSTRAINT FK_solicitacao_cliente
    FOREIGN KEY (Cliente)
    REFERENCES cliente (Identificador);

ALTER TABLE cliente ADD CONSTRAINT FK_cliente_setor
    FOREIGN KEY (Setor)
    REFERENCES setor (Identificador);

ALTER TABLE cliente ADD CONSTRAINT FK_cliente_curso
    FOREIGN KEY (Curso)
    REFERENCES curso (Identificador);

-- Dados para iniciais para tabela Curso
INSERT INTO curso (Curso) VALUES ('Analise e Desenvolvimento');
INSERT INTO curso (Curso) VALUES ('Sistema da Informação');
INSERT INTO curso (Curso) VALUES ('Medicina');
INSERT INTO curso (Curso) VALUES ('Engenharia');
INSERT INTO curso (Curso) VALUES ('Ciência da Computação');

-- Dados para iniciais para tabela Setor
INSERT INTO setor (Setor) VALUES ('Tecnico');
INSERT INTO setor (Setor) VALUES ('Financeiro');
INSERT INTO setor (Setor) VALUES ('Recursos Humanos');
INSERT INTO setor (Setor) VALUES ('Outros');

-- Query de inserção de cliente na tabela
-- 1 valor inicial para ser listado na Administração
INSERT INTO `cliente` (`CodigoCliente`, `Nome`, `Celular`, `Email`, `Rua`, `Numero`, `Bairro`, `Cidade`, `Cep`, `Estado`, `TipoCliente`, `Setor`, `Curso`) VALUES ('0000000', 'Irmão do Jorel', '(35)99110-5312', 'irmaodojorel@gmail.com', 'Av do Irmão do Jorel', '13', 'Centro', 'Carmo da Cachoeira', '37225-000', 'MG', '1', '1', '1');

-- Query de inserção de solicitação na solicitacao
-- 2 valores iniciais para ser listado na Administração
INSERT INTO `solicitacao` (`Cliente`, `ServicoSolicitado`, `DataSolicitacao`) VALUES ('1', 'Concertar o poste de luz', now());
INSERT INTO `solicitacao` (`Cliente`, `ServicoSolicitado`, `DataSolicitacao`) VALUES ('1', 'Reinstalar mysql nos computadores do laboratório', now());