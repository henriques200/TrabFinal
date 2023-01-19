CREATE DATABASE EQUIP_BD;

USE EQUIP_BD;

CREATE TABLE GRUPO(
    Nome VARCHAR(255) PRIMARY KEY,
    Dono VARCHAR(255) NOT NULL,
    Phone INT NOT NULL,
    NIF INT NOT NULL
);

CREATE TABLE SISTEMA(
    Nome VARCHAR(255) PRIMARY KEY NOT NULL,
    Fabricante VARCHAR(255) NOT NULL
);

CREATE TABLE COMANDO(
    Nome_codigo VARCHAR(255) PRIMARY KEY NOT NULL,
    Comando VARCHAR(255) NOT NULL,
    Descricao VARCHAR(255),
    OS VARCHAR(255) NOT NULL,
    CONSTRAINT oscmd_nome FOREIGN KEY (OS) REFERENCES SISTEMA(Nome)
);

CREATE TABLE EQUIPAMENTO (
    Nome VARCHAR(255) PRIMARY KEY NOT NULL,
    Ip_Nome VARCHAR(255) NOT NULL,
    Username VARCHAR(255) NOT NULL,
    Pass VARCHAR(255),
    OS VARCHAR(255) NOT NULL,
    Grupo VARCHAR(255) NOT NULL,
    CONSTRAINT fk_os_nome FOREIGN KEY (OS) REFERENCES SISTEMA(Nome),
    CONSTRAINT fk_grupo_nomegrupo FOREIGN KEY (Grupo) REFERENCES GRUPO(Nome)
);

INSERT INTO SISTEMA (Nome, Fabricante)
VALUES
    ('Windows10', 'Microsoft'),
    ('Ubuntu20.04', 'Canonical'),
    ('RouterOS', 'Microtik'),
    ('SwitchOS', 'Microtik'),
    ('Cisco IOS', 'Cisco'),
    ('CentOS', 'RedHat'),
    ('Windows Server 2016', 'Microsoft'),
    ('pfSense', 'Netgate');

INSERT INTO GRUPO (Nome, Dono, Phone, NIF)
VALUES
    ('Grupo 1', 'Emanuel Henriques', 911223344, 273300143),
    ('Grupo 2', 'Rui Duarte', 967125479, 21253641),
    ('Grupo 3', 'Paulo Duarte', 914822314, 197456321),
    ('Grupo 4', 'Diogo Salgado', 965412365, 123456789),
    ('Grupo 5', 'Leonardo Videira', 96516574, 987654321),
    ('Grupo 6', 'André Matias', 975312548, 741258963);

INSERT INTO COMANDO (Nome_codigo, Comando, Descricao, OS) 
VALUES
    ('UpContainers', 'docker-compose up -d', 'Iniciar containers c/ docker-compose', 'Ubuntu20.04'),
    ('WinIP', 'ipconfig /all', 'Verificar IPs Win', 'Windows10'),
    ('UpdateUbuntu', 'apt -y update && apt -y upgrade', 'Atualizar SO ubuntu', 'Ubuntu20.04'),
    ('IPRoute_IOS', 'show ip route', 'Routing IOS', 'Cisco IOS'),
    ('RouterOS_IP', 'ip address print', 'Mostrar IPs RouterOS', 'RouterOS');

INSERT INTO EQUIPAMENTO (Nome, Ip_Nome, Username, Pass, OS, Grupo)
VALUES
    ('Router1', '192.168.10.254', 'admin', 'admin', 'Cisco IOS', 'Grupo 1'),
    ('Server2', 'server1.home.local', 'root', '1234545', 'Ubuntu20.04', 'Grupo 3'),
    ('SW1', '192.168.10.107', 'mikrotik', 'Passw0rd', 'RouterOS', 'Grupo 1');