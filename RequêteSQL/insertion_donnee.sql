

INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES('liusiqi','0000','liu', 'siqi', '1999-05-02', '3 avenue des Templiers', false );
INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES('lemairepierre','000','lemaire', 'pierre', '2012-05-02', '3 rue des Templiers', false );
INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES('trotignonhugo','00','trotignon', 'hugo', '600-05-02', '3 rue des Templiers', false );
INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES('daragonmaxime','0','trotignon', 'hugo', '600-05-02', '3 rue des Templiers', false );
INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES('toto','00','t', 'h', '600-05-02', '3 rue des Templiers', false );
INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES('tata','0000','l', 's', '1999-05-02', '3 avenue des Templiers', false );
INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES('tbtb','000','le', 'p', '2012-05-02', '3 rue des Templiers', false );
INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES('tctc','00','tro', 'hu', '600-05-02', '3 rue des Templiers', false );
INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES('tdtd','0','trot', 'hug', '600-05-02', '3 rue des Templiers', false );
INSERT INTO tMembres (login,pwd,nom,prenom,dateDeNaissance,adresse, admin)
VALUES('tete','00','tete', 'hugol', '600-05-02', '3 rue des Templiers', false );


INSERT INTO tOrganisateurs (login,annee,telephone)
VALUES('liusiqi','2000', '0650536260' );
INSERT INTO tOrganisateurs (login,annee,telephone)
VALUES('tctc','2005', '0650536560' );
INSERT INTO tOrganisateurs (login,annee,telephone)
VALUES('toto','2010', '0650536265' );


INSERT INTO tJoueurs (login)
VALUES('lemairepierre' );
INSERT INTO tJoueurs (login)
VALUES('trotignonhugo');
INSERT INTO tJoueurs (login)
VALUES('tete');
INSERT INTO tJoueurs (login)
VALUES('tdtd');
INSERT INTO tJoueurs (login)
VALUES('tbtb');
INSERT INTO tJoueurs (login)
VALUES('tata');
INSERT INTO tJoueurs (login)
VALUES('daragonmaxime');



INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES('inventionNecrovore','l assemblée', '2007-09-01' );
INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES('effetLift','l assemblée', '2007-09-01' );
INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES('ressourceElectricité','l assemblée', '2007-09-01' );
INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES('faculté1','l assemblée1', '2007-09-01' );
INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES('faculté5','l assemblée2', '2004-09-01' );
INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES('faculté4','l assemblée3', '2005-09-01' );
INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES('faculté3','l assemblée4', '2002-09-01' );
INSERT INTO tCartes (nom,extensionStS,dateInterdite)
VALUES('faculté2','l assemblée5', '2001-09-01' );

INSERT INTO tCartesInvention (nom,potentielAttaque,potentielDefense, coutRessource)
VALUES('inventionNecrovore','250','0','10000' );



INSERT INTO tCartesRessource (nom,nbPoints)
VALUES('ressourceElectricité','5');


INSERT INTO tCartesEffet (nom,coutRessource)
VALUES('effetLift','5');



INSERT INTO tFacultes (nom,description)
VALUES('faculté1','description1');




INSERT INTO tTournois (annee,Tdate)
VALUES('1999','07-09-1999');
INSERT INTO tTournois (annee,Tdate)
VALUES('1999','07-09-1999');
INSERT INTO tTournois (annee,Tdate)
VALUES('2000','08-02-2000'); /* Faire un check pour vérifier que les deux années sont cohérentes*/

INSERT INTO tMatchs (annee_tournoi,horaire,jour,numeroTable,numeroSalle,victoire,j1,j2)
VALUES('1999','13:50:00','1999-09-01',7, 8, 1, 'lemairepierre', 'trotignonhugo');




INSERT INTO tParticipations (login,annee,surnom,nomDeck)
VALUES('lemairepierre', '1999', 'surnomPierre', 'DeckPietro');
INSERT INTO tParticipations (login,annee,surnom,nomDeck)
VALUES('trotignonhugo', '1999','surnomHugo',' DeckHugo');



INSERT INTO tDecks (login,annee,nom)
VALUES('trotignonhugo', '1999','inventionNecrovore');

INSERT INTO tDecks (login,annee,nom)
VALUES('lemairepierre', '1999', 'inventionNecrovore');

INSERT INTO tTournois(annee, Tdate)
VALUES('1999', '1999-09-01');

INSERT INTO tOrganisateurs (login,annee,telephone)
VALUES('trotignonhugo', '1999','0650533065');

