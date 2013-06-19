DROP TABLE IF EXISTS tOrganisateurs CASCADE;
DROP TABLE IF EXISTS tJoueurs CASCADE;
DROP TABLE IF EXISTS tCartes CASCADE;
DROP TABLE IF EXISTS tCartesInvention CASCADE;
DROP TABLE IF EXISTS tCartesRessource CASCADE;
DROP TABLE IF EXISTS tCartesEffet CASCADE;
DROP TABLE IF EXISTS tFacultes CASCADE;
DROP TABLE IF EXISTS tTournois CASCADE;
DROP TABLE IF EXISTS tParticipations CASCADE;
DROP TABLE IF EXISTS tDecks CASCADE;
DROP TABLE IF EXISTS tMatchs CASCADE;
DROP TABLE IF EXISTS tMembres CASCADE;
﻿


CREATE TABLE tMembres
(
	login varchar(25) PRIMARY KEY,
	pwd varchar(25),
	nom varchar(25),
	prenom varchar(25),
	dateDeNaissance date,
	adresse varchar(100)
);



CREATE TABLE tJoueurs 
(
	login varchar(25),
	PRIMARY KEY(login),
	FOREIGN KEY(login) REFERENCES tMembres(login)
);




CREATE TABLE tCartes(  
	nom varchar(25),
	extensionStS varchar(25),
	dateInterdite date,
	PRIMARY KEY(nom)
);




CREATE TABLE tCartesInvention          
(
	nom varchar(25),
	potentielAttaque int NOT NULL,
	potentielDefense int NOT NULL,
	coutRessource int NOT NULL,
	PRIMARY KEY(nom)
);



CREATE TABLE tCartesRessource
(
	nom varchar(25),
	nbPoints int NOT NULL,
	PRIMARY KEY(nom),
	FOREIGN KEY(nom) REFERENCES tCartes(nom)
);



CREATE TABLE tCartesEffet
(
	nom varchar(25),
	coutRessource int NOT NULL,
	PRIMARY KEY(nom),
	FOREIGN KEY(nom) REFERENCES tCartes(nom)
);



CREATE TABLE tFacultes
(
	nom varchar(25),
	description varchar(100) NOT NULL,
	FOREIGN KEY(nom) REFERENCES tCartes(nom)
);




CREATE TABLE tTournois
(
	annee int,
	Tdate date, 
	PRIMARY KEY(annee)
);  

-- TODO trigger sur l'insertion pour vérifier la cohérence entre année date


3

CREATE TABLE tOrganisateurs 
(
	login varchar(25),
	annee int,
	telephone varchar(10),
	PRIMARY KEY(login, annee),
	FOREIGN KEY(login) REFERENCES tMembres (login),
	FOREIGN KEY(annee) REFERENCES tTournois (annee)
	
);


CREATE SEQUENCE key_column_seq;
CREATE TABLE tMatchs
(
	key_column bigint not null autoincrement,
	annee_tournoi int UNIQUE NOT NULL,
	horaire time UNIQUE NOT NULL, 
	jour date UNIQUE NOT NULL,
	numeroTable UNIQUE int NOT NULL,
	numeroSalle UNIQUE int NOT NULL,
	victoire int CHECK (victoire IN (1,2,0)), 
	j1 varchar(25),
	j2 varchar(25),
	key_column bigint  /cle artificielle simplifiant l'implémentation
	PRIMARY KEY(key_column),
	FOREIGN KEY(annee_tournoi) REFERENCES tTournois(annee),
	FOREIGN KEY(j1) REFERENCES tJoueurs(login),
	FOREIGN KEY(j2) REFERENCES tJoueurs(login),
	CHECK (date_part('year'::text, jour) = annee_tournoi::double precision),
	CHECK (j1::text <> j2::text),
	CHECK (victoire = ANY (ARRAY[0,1,2])),
	
	
);



CREATE TABLE tParticipations
(
	login varchar(25),
	annee int,
	surnom varchar(25) UNIQUE NOT NULL,
	nomDeck varchar(25) UNIQUE NOT NULL,
	PRIMARY KEY(login, annee),
	FOREIGN KEY(login) REFERENCES tJoueurs(login),
	FOREIGN KEY(annee) REFERENCES tTournois(annee)
);



CREATE TABLE tDecks
(
	login varchar(25),
	annee int,
	nom varchar(25),
	PRIMARY KEY(login, annee, nom),
	FOREIGN KEY(login, annee) REFERENCES tParticipations(login, annee),
	FOREIGN KEY(nom) REFERENCES tCartes(nom)
	-- /*CHECK (COUNT(nom)<=30) @TODO faire u ntrigger */
);
