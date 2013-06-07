/*
CREATE TABLE tMembres
(
	login varchar(25),
	pwd varchar(25), 
	nom varchar(25),
	prenom varchar(25),
	dateDeNaissance date,
	adresse varchar(100),
	admin boolean
	PRIMARY KEY(login)
)
*/


INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES(liusiqi,0000,liu, siqi, 1999-05-02, 3 rue des Templiers, false )

INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES(lemairepierre,000,lemaire, pierre, 2012-05-02, 3 rue des Templiers, false )

INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES(trotignonhugo,00,trotignon, hugo, 600-05-02, 3 rue des Templiers, false )


/*
CREATE TABLE tOrganisateurs
(
	login varchar(25),
	annee int,
	telephone varchar(8),
	PRIMARY KEY(login, annee),
	FOREIGN KEY(login) REFERENCES (tMembres),
	FOREIGN KEY(annee) REFERENCES (tTournois),
	SELECT Ol, Ml
	FROM organisteur.login Ol, Membre.login Ml
	WHERE Ol = Ml
)
*/


INSERT INTO tOrganisateurs (login,anne,telephone)
VALUES(liusiqi,2000-05-02, 0650536260 )

/*
CREATE TABLE tJoueurs
(
	login varchar(25),
	PRIMARY KEY(login),
	FOREIGN KEY(login) REFERENCES (tMembres)
)
*/
INSERT INTO tJoueurs (login)
VALUES(lemairepierre )
INSERT INTO tJoueurs (login)
VALUES(trotignonhugo)

/*
CREATE TABLE tCartes(
	nom varchar(25),
	extensionStS varchar(25),
	dateInterdite date,
	PRIMARY KEY(nom)
)
*/

INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES(inventionNecrovore,l assemblée, 2007-09-01 )
INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES(effetLift,l assemblée, 2007-09-01 )
INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES(ressourceElectricité,l assemblée, 2007-09-01 )
INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES(faculté1,l assemblée, 2007-09-01 )


/*
CREATE TABLE tCartesInvention
(
	nom varchar(25),
	potentielAttaque int, NOT NULL
	potentielDefense int, NOT NULL
	coutRessource int, NOT NULL
	PRIMARY KEY(nom)
)
*/


INSERT INTO tCartesInvention (nom,potentielAttaque,potentielDefense, coutRessource)
VALUES(inventionNecrovore,250,0,10000 )

/*
CREATE TABLE tCartesRessource
(
	nom varchar(25),
	nbPoints int, NOT NULL
	PRIMARY KEY(nom)
	FOREIGN KEY(nom) REFERENCES (tCartes)
)
*/

INSERT INTO tCartesRessource (nom,nbPoints)
VALUES(ressourceElectricité,5)

/*
CREATE TABLE tCartesEffet
(
	nom varchar(25),
	coutRessource int, NOT NULL
	PRIMARY KEY(nom),
	FOREIGN KEY(nom) REFERENCES(tCartes)
)
*/
INSERT INTO tCartesEffet (nom,coutRessource)
VALUES(effetLift,5)

/*
CREATE TABLE tFacultes
(
	nom varchar(25),
	description varchar(100), NOT NULL
	PRIMARY KEY(nom) REFERENCES(tCartes)
)
*/

INSERT INTO tFacultes (nom,description)
VALUES(faculté1,description1)

/*
CREATE TABLE tTournois
(
	annee int,
	Tdate int, /* Ici j'ai mis un int parce que je ne trouve pas de date style mm-jj. Il y a mm-jj-yyyy mais c'est tout 
	PRIMARY KEY(annee)
)
*/


INSERT INTO tTournois (anne,Tdate)
VALUES(1999,0709)

/*
CREATE TABLE tMatchs
(
	annee_tournoi int,
	horaire time, /* normalement time existe 
	jour date,
	numeroTable int,
	numeroSalle int,
	victoire boolean, /* c'est pas plus simple de faire un bool ici ? Vrai si le joueur 1 gagne, faux sinon. Je dit ça parce que je connais pas de type correspondant à ce qu'on veut donc j'imagine que vous voulez mettre une contraite ce qui est un peu dommage si on peut faire plus simple non ?
	j1 varchar(25),
	j2 varchar(25),
	PRIMARY KEY(annee_tournoi, horaire, jour, numeroSalle, numeroTable),
	FOREIGN KEY(annee_tournoi) REFERENCES(tTournois)
	FOREIGN KEY(j1) REFERENCES tJoueurs(login)
	FOREIGN KEY(j2) REFERENCES tJoueurs(login)
)
*/

INSERT INTO tMatchs (annee_tournoi,horaire,jour,numeroTable,numeroSalle,victoire,j1,j2)
VALUES(1999,13-50-00,1999-09-01, 7, 8, true, lemairepierre, trotignonhugo)

/*
CREATE TABLE tParticipations
(
	login varchar(25),
	annee int,
	surnom varchar(25), UNIQUE NOT NULL
	nomDeck varchar(25), UNIQUE NOT NULL
	PRIMARY KEY(login, annee)
	FOREIGN KEY(login) REFERENCES tJoueurs(login)
	FOREIGN KEY(annee) REFERENCES tTournois(annee)
)
*/


INSERT INTO tParticipations (login,annee,surnom,nomDeck)
VALUES(lemairepierre, 1999, surnomPierre, DeckPietro)


INSERT INTO tParticipations (login,annee,surnom,nomDeck)
VALUES(trotignonhugo, 1999, surnomHugo, DeckHugo)

/*
CREATE TABLE tDecks
(
	login varchar(25),
	annee int,
	nom varchar(25),
	PRIMARY KEY(login, annee, nom)
	FOREIGN KEY(login, annee) REFERENCES tParticipations(login, annee)
	FOREIGN KEY(nom) REFERENCES tCartes(nom)
	CHECK (COUNT(nom)<=30) GROUP BY nomDeck
)
*/

INSERT INTO tDecks (login,annee,nom)
VALUES(trotignonhugo, 1999, DeckHugo

INSERT INTO tDecks (login,annee,nom)
VALUES(lemairepierre, 1999, DeckPietro)

