CREATE DATABASE HoraDeAprenderIngles;

USE HoraDeAprenderIngles;

CREATE TABLE usuarios (
	NombreUsuario varchar(20) NOT NULL PRIMARY KEY,
	Correo varchar(200) NOT NULL,
	Contrasena varchar(50) NOT NULL
);

CREATE TABLE usuarios_comun (
	NomUsuarioComun varchar(20) NOT NULL PRIMARY KEY,
	Puntuacion smallint NULL,
	IdFrase int NOT NULL
);

CREATE TABLE usuarios_administrador (
	NomUsuarioAdministrador varchar(20) NOT NULL PRIMARY KEY,
	NumEjerciciosCreados smallint NULL
);

CREATE TABLE frases (
	IdFrase int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Texto varchar(100) NOT NULL
);

CREATE TABLE frases_palabras (
	IdFrase int NOT NULL,
	Posicion tinyint NOT NULL,
	PRIMARY KEY(IdFrase, Posicion),
	Palabra varchar(20) NOT NULL
);


ALTER TABLE usuarios_comun ADD CONSTRAINT FK_Nombre_Usuarios FOREIGN KEY (NomUsuarioComun) REFERENCES usuarios(NombreUsuario);
ALTER TABLE usuarios_administrador ADD CONSTRAINT FK_Nombre_Usuarios_ADM FOREIGN KEY (NomUsuarioAdministrador) REFERENCES usuarios(NombreUsuario);
ALTER TABLE usuarios_comun ADD CONSTRAINT FK_IdFrase_Usuarios FOREIGN KEY (IdFrase) REFERENCES frases(IdFrase);
ALTER TABLE frases_palabras ADD CONSTRAINT FK_IdFrase_Frases FOREIGN KEY (IdFrase) REFERENCES frases(IdFrase) ON DELETE CASCADE;
