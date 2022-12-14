-- Criar base de dados
CREATE DATABASE EQUIP_BD;

-- Trabalhar na base de dados
USE EQUIP_BD; 

--Criar tabelas
CREATE TABLE GRUPO(
    Nome VARCHAR(255) NOT NULL,
    Dono VARCHAR(255) NOT NULL,
    Phone INT NOT NULL,
    NIF INT NOT NULL,
    PRIMARY KEY(NIF)
);

CREATE TABLE SISTEMA(
    Nome VARCHAR(255) NOT NULL,
    Fabricante VARCHAR(255) NOT NULL,
    PRIMARY KEY(Nome)
);

CREATE TABLE COMANDO(
    Nome_codigo VARCHAR(255) NOT NULL,
    Comando VARCHAR(255) NOT NULL,
    Descricao VARCHAR(255),
    OS VARCHAR(255) NOT NULL,
    PRIMARY KEY(Nome_codigo),
    FOREIGN KEY (OS) REFERENCES SISTEMA(Nome)
);

CREATE TABLE EQUIPAMENTO (
    Nome VARCHAR(255) NOT NULL,
    Ip_Nome VARCHAR(255) NOT NULL,
    Username VARCHAR(255) NOT NULL,
    Pass VARCHAR(255),
    OS VARCHAR(255) NOT NULL,
    Grupo VARCHAR(255) NOT NULL,
    -- Uso de Constraints para especificar regras
    CONSTRAINT PrimKey PRIMARY KEY(Nome),
    FOREIGN KEY (OS) REFERENCES SISTEMA(Nome),
    FOREIGN KEY (Grupo) REFERENCES GRUPO(Nome)
);

-- Inserir valores na tabela SISTEMA
INSERT INTO SISTEMA (Nome, Fabricante)
VALUES
    ('Windows10', 'Microsoft'),
    ('Ubuntu20.04', "Canonical"),
    ('RouterOS', 'Microtik'),
    ('SwitchOS', 'Microtik'),
    ('Cisco IOS', 'Cisco');
