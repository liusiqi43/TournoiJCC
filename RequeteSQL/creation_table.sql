
DROP TABLE IF EXISTS tOrganisateurs CASCADE;
/*DROP TABLE IF EXISTS tJoueurs CASCADE;*/
/*DROP TABLE IF EXISTS tCartes CASCADE;*/
DROP TABLE IF EXISTS tCartesInvention CASCADE;
DROP TABLE IF EXISTS tCartesRessource CASCADE;
DROP TABLE IF EXISTS tCartesEffet CASCADE;
DROP TABLE IF EXISTS tFacultes CASCADE;
DROP TABLE IF EXISTS tTournois CASCADE;
DROP TABLE IF EXISTS tParticipations CASCADE;
DROP TABLE IF EXISTS tDecks CASCADE;
DROP TABLE IF EXISTS tMatchs CASCADE;
/*DROP TABLE IF EXISTS tMembres CASCADE;*/
﻿

-- tMembres(			//Membres
-- #login	string,
-- pwd		string,
-- nom		string,
-- prenom	string,
-- dateDeNaissance	date,
-- adresse	string,
-- admin	boolean
-- )


/* Celle là, il faut la créer à la main, je sais pas pourquoi. Si on copie colle l'instruction dans le terminal, ça marche, mais si on appel le fichier, ça marche pas.
CREATE TABLE tMembres
(
	login varchar(25) PRIMARY KEY,
	admin boolean,
	pwd varchar(25),
	nom varchar(25),
	prenom varchar(25),
	dateDeNaissance date,
	adresse varchar(100)
);*/ 


/*
tJoueurs(			//Joueurs
#login => tMembres,
)
*/

/*CREATE TABLE tJoueurs Celle là, il faut la créer à la main, je sais pas pourquoi. Si on copie colle l'instruction dans le terminal, ça marche, mais si on appel le fichier, ça marche pas.
(
	login varchar(25),
	PRIMARY KEY(login),
	FOREIGN KEY(login) REFERENCES tMembres(login)
);*/


/*
tCartes(				//Cartes 
#nom			string,
extentionStS	string,
dateInterdite	date
)
*/

/*CREATE TABLE tCartes(  Celle là, il faut la créer à la main, je sais pas pourquoi. Si on copie colle l'instruction dans le terminal, ça marche, mais si on appel le fichier, ça marche pas.
	nom varchar(25),
	extensionStS varchar(25),
	dateInterdite date,
	PRIMARY KEY(nom)
);*/


/*
tCartesInvention(		//Inventions
#nom => tCartes
potentielAttaque	integer NOT NULL,
potentielDefense	integer NOT NULL,
coutRessource		integer NOT NULL,
)
*/

/*CREATE TABLE tCartesInvention           Celle là, il faut la créer à la main, je sais pas pourquoi. Si on copie colle l'instruction dans le terminal, ça marche, mais si on appel le fichier, ça marche pas.
(
	nom varchar(25),
	potentielAttaque int NOT NULL,
	potentielDefense int NOT NULL,
	coutRessource int NOT NULL,
	PRIMARY KEY(nom)
);*/

/*
tCartesRessource(		//Ressources
#nom => tCartes,
nbPoints	integer NOT NULL,
)
*/

CREATE TABLE tCartesRessource
(
	nom varchar(25),
	nbPoints int NOT NULL,
	PRIMARY KEY(nom),
	FOREIGN KEY(nom) REFERENCES tCartes(nom)
);

/*
tCartesEffet(			//Effets
#nom => tCartes,
coutRessource	integer NOT NULL,
)
*/

CREATE TABLE tCartesEffet
(
	nom varchar(25),
	coutRessource int NOT NULL,
	PRIMARY KEY(nom),
	FOREIGN KEY(nom) REFERENCES tCartes(nom)
);

/* tFacultes(				//Facultés
#nom => tCartes,
description		string NOT NULL,
)
*/

CREATE TABLE tFacultes
(
	nom varchar(25),
	description varchar(100) NOT NULL,
	FOREIGN KEY(nom) REFERENCES tCartes(nom)
);

/*
tTournois(							//Tournois
#annee	integer,
date date(mm-jj),
)
*/


CREATE TABLE tTournois
(
	annee int,
	Tdate date, 
	PRIMARY KEY(annee)
);  

-- TODO trigger sur l'insertion pour vérifier la cohérence entre année date


/*
tOrganisateurs(		//Organisateurs
#login => tMembres,
#annee => Tournoi
telephone	string
)
--- PROJ (Organisateur,login) IN PROJ(Membre,login)
*/

CREATE TABLE tOrganisateurs 
(
	login varchar(25),
	annee int,
	telephone varchar(10),
	PRIMARY KEY(login, annee),
	FOREIGN KEY(login) REFERENCES tMembres (login),
	FOREIGN KEY(annee) REFERENCES tTournois (annee)
	
);

/*
tMatchs(							//Matchs
#anne_tournoi => tTournois.annee,
#horaire		heure,
#jour 			date,
#numeroTable	integer,
#numeroSalle	integer,
victoire		integer{1 ou 2},
j1 => tJoueurs.login,
j2 => tJoueurs.login
)
*/

CREATE TABLE tMatchs
(
	annee_tournoi int,
	horaire time, /* normalement time existe */
	jour date,
	numeroTable int,
	numeroSalle int,
	victoire int CHECK (victoire IN (1,2)), /* c'est pas plus simple de faire un bool ici ? Vrai si le joueur 1 gagne, faux sinon. Je dit ça parce que je connais pas de type correspondant à ce qu'on veut donc j'imagine que vous voulez mettre une contraite ce qui est un peu dommage si on peut faire plus simple non ?*/
	j1 varchar(25),
	j2 varchar(25),
	PRIMARY KEY(annee_tournoi, horaire, jour, numeroSalle, numeroTable),
	FOREIGN KEY(annee_tournoi) REFERENCES tTournois(annee),
	FOREIGN KEY(j1) REFERENCES tJoueurs(login),
	FOREIGN KEY(j2) REFERENCES tJoueurs(login)
);

/*
tParticipations(					//Participations
#login => tJoueurs,
#annee => tTournois,
surnom UNIQUE NOT NULL,
nomDeck => tDecks
)
--- nomDeck UNIQUE NOT NULL,
*/

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

/*
tDecks(								//Decks
#login => tParticipations,
#annee => tParticipations,
#nom => tCartes
)
--- CHECK ( COUNT(nom) <= 30 ) GROUP BY nomDeck
*/

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
